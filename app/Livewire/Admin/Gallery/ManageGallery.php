<?php

namespace App\Livewire\Admin\Gallery;
use App\Models\GalleryImage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class ManageGallery extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $showCreateModal = false;
    public $showEditModal = false;
    public $editId = null;

    #[On('close-edit-modal')] 
    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->editId = null;
    }

    public function closeModal()
    {
     $this->showEditModal = false;
     $this->editId = null;
    }

    public function refreshList()
    {
        $this->resetPage();
        $this->closeModals();
    }
    protected $listeners = [
        'imageCreated' => 'refreshList',
        'imageUpdated' => 'refreshList',
        'closeEditModal' => 'closeModal'
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
            $this->dispatch('openCreateModal'); 

    }

    public function openEditModal($id)
    {
        $this->editId = $id;
        $this->showEditModal = true;
    }

    public function deleteImage($id)
    {
        try {
            GalleryImage::find($id)->delete();
            session()->flash('message', 'Image deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting image: ' . $e->getMessage());
        }
    }


       #[Layout('components.layouts.admin')]

    public function render()
    {
        $images = GalleryImage::query()
            ->when($this->search, function ($query) {
                return $query->where('alt', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.gallery.manage-gallery', [
            'images' => $images
        ]);
    }
}
