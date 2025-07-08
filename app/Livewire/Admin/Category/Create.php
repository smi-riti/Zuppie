<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use ImageKit\ImageKit;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $image;
    public $categories;
    public $form = [
        'name' => '',
        'description' => '',
        'parent_id' => null,
        'is_special' => false, // Add this line
    ];
    public $editingId = null;
    public $showModal = false;
    protected $rules = [
        'form.name' => 'required|string|max:255|unique:categories,name',
        'form.description' => 'nullable|string',
        'form.parent_id' => 'nullable|exists:categories,id',
        'form.is_special' => 'boolean', // Add this line
    ];

    protected $messages = [
        'form.name.required' => 'The category name is required.',
        'form.name.unique' => 'This category already exists.'
    ];
    public function loadCategories()
    {
        $this->categories = Category::all();
    }

    #[On('open-create-modal')]
    public function openModal($editId = null)
    {
        $this->resetForm();
        $this->editingId = $editId;

        if ($editId) {
            $category = Category::findOrFail($editId);
            $this->form = [
                'name' => $category->name,
                'description' => $category->description,
                'parent_id' => $category->parent_id,
                'is_special' => (bool) $category->is_special, // Add this line
            ];
            $this->rules['form.name'] = 'required|string|max:255|unique:categories,name,' . $editId;
        }

        $this->showModal = true;
    }
    public function saveCategory()
    {
        $this->validate([
            'form.name' => 'required|string|max:255|unique:categories,name' . ($this->editingId ? ',' . $this->editingId : ''),
            'form.description' => 'nullable|string',
            'form.parent_id' => 'nullable|exists:categories,id',
            'form.is_special' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageUrl = null;
        $imageFileId = null;

        if ($this->image) {
            $publicKey = config('imagekit.public_key', env('IMAGEKIT_PUBLIC_KEY'));
            $privateKey = config('imagekit.private_key', env('IMAGEKIT_PRIVATE_KEY'));
            $urlEndpoint = config('imagekit.url_endpoint', env('IMAGEKIT_URL_ENDPOINT'));
            if (empty($publicKey) || empty($privateKey) || empty($urlEndpoint)) {
                throw new \Exception('ImageKit credentials are missing. Please check your .env and config/imagekit.php.');
            }
            $imagekit = new ImageKit(
                $publicKey,
                $privateKey,
                $urlEndpoint
            );

            $localPath = $this->image->getRealPath();
            $fileName = $this->image->getClientOriginalName();

            $fileResource = fopen($localPath, 'r');
            if ($fileResource === false) {
                throw new \Exception('Failed to open image file for upload.');
            }
            try {
                $response = $imagekit->upload([
                    'file' => $fileResource,
                    'fileName' => $fileName,
                    'folder' => '/Zuppie/CategoryImages/',
                    'useUniqueFileName' => true,
                ]);
            } finally {
                if (is_resource($fileResource)) {
                    fclose($fileResource);
                }
            }

            if (isset($response->result) && !empty($response->result->url)) {
                $imageUrl = $response->result->url;
                $imageFileId = $response->result->fileId;
            } else {
                $errorMsg = 'Image upload failed.';
                if (isset($response->error)) {
                    $errorMsg .= ' ImageKit error: ' . json_encode($response->error);
                } else {
                    $errorMsg .= ' No URL returned from ImageKit. Full response: ' . json_encode($response);
                }
                \Log::error($errorMsg);
                session()->flash('error', $errorMsg);
                return;
            }
        }

        $data = $this->form;
        if ($imageUrl) {
            $data['image'] = $imageUrl;
            $data['image_file_id'] = $imageFileId;
        }

        if ($this->editingId) {
            Category::find($this->editingId)->update($data);
            $message = 'Category updated successfully!';
            $this->loadCategories();
        } else {
            Category::create($data);
            $message = 'Category created successfully!';
            $this->loadCategories();
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('status', $message);
    }
    public function resetForm()
    {
        $this->form = [
            'name' => '',
            'description' => '',
            'parent_id' => null,
            'is_special' => false, // Add this line
        ];
        $this->editingId = null;
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.admin.category.create',[
            'parentCategories' => Category::all()
        ]);
    }
}
