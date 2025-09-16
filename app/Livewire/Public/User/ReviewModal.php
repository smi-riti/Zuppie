<?php

namespace App\Livewire\Public\User;

use App\Helpers\ImageKitHelper;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\review_images;
use App\Models\reviews;
use ImageKit\ImageKit;
use Livewire\WithFileUploads;
use Livewire\Component;
#[Title('Review Modal')]
class ReviewModal extends Component
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
    public $showReviewModal = false;
    public $packageDetails;
    public $package;

    public function mount($packageId)
    {
        $this->package = EventPackage::findOrFail($packageId);
    }
    public function openReviewModal($packageId)
    {
        dd($packageId);
        $this->showReviewModal = true;
        $this->packageDetails = EventPackage::findOrFail($packageId);
    }

    public function closeReviewModal()
    {
        $this->dispatch('closeReviewModal');
    }



    public function submitReview()
    {
        $this->validate();

        $review = reviews::create([
            'event_package_id' => $this->package['id'],
            'rating' => $this->rating,
            'user_id' => auth()->id(),
            'comment' => $this->comment,
        ]);

        $imageUrls = [];
        $imageFileIds = [];

        if ($this->images && is_array($this->images)) {
            foreach ($this->images as $image) {
                try {
                    $uploadResult = ImageKitHelper::uploadImage(
                        $image,
                        '/Zuppie/ReviewImages/' // Your custom folder
                    );

                    if ($uploadResult) {
                        $imageUrls[] = $uploadResult['url'];
                        $imageFileIds[] = $uploadResult['fileId'];
                    } else {
                        session()->flash('error', 'Failed to upload one or more images');
                        return;
                    }
                } catch (\Exception $e) {
                    \Log::error('Image upload error: ' . $e->getMessage());
                    session()->flash('error', 'Image upload failed: ' . $e->getMessage());
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
        $this->dispatch('reviewSubmitted');
    }
    public function render()
    {
        return view('livewire.public.user.review-modal');
    }
}
