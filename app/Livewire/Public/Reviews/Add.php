<?php

namespace App\Livewire\Public\Reviews;

use App\Models\review_images;
use App\Models\reviews;
use ImageKit\ImageKit;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $rating;
    public $comment;
    public $images = [];

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
        'images.*' => 'nullable|image|max:2048',
    ];

    public function submitReview()
    {
        $this->validate();
        $review = reviews::create([
            'booking_id' => 1,
            'rating' => $this->rating,
            'user_id' => 1,
            'comment' => $this->comment,
        ]);

        $imageUrls = [];
        $imageFileIds = [];

        if ($this->images && is_array($this->images)) {
            foreach ($this->images as $image) {
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

                $localPath = $image->getRealPath();
                $fileName = $image->getClientOriginalName();

                $fileResource = fopen($localPath, 'r');
                if ($fileResource === false) {
                    throw new \Exception('Failed to open image file for upload.');
                }
                try {
                    $response = $imagekit->upload([
                        'file' => $fileResource,
                        'fileName' => $fileName,
                        'folder' => '/Zuppie/ReviewImages/',
                        'useUniqueFileName' => true,
                    ]);
                } finally {
                    if (is_resource($fileResource)) {
                        fclose($fileResource);
                    }
                }

                if (isset($response->result) && !empty($response->result->url)) {
                    $imageUrls[] = $response->result->url;
                    $imageFileIds[] = $response->result->fileId;
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
        }

        foreach ($imageUrls as $key => $imageUrl) {
            review_images::create([
                'review_id' => $review->id,
                'image' => $imageUrl,
                'image_file_id' => $imageFileIds[$key],
            ]);
        }

        $this->reset(['rating', 'comment', 'images']);
        session()->flash('message', 'Review submitted successfully!');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.reviews.add');
    }
}
