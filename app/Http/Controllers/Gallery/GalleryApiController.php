<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Category;
use App\Helpers\ImageKitHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GalleryApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $images = GalleryImage::with('category')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $images,
                'message' => 'Gallery images retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Gallery index error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve gallery images'
            ], 500);
        }
    }

    // Store multiple gallery images
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1|max:20',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'sometimes|array',
            'alt.*' => 'nullable|string|max:255',
            'category_id' => 'sometimes|array',
            'category_id.*' => 'nullable|exists:categories,id',
            'description' => 'sometimes|array',
            'description.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }

        try {
            $uploadedImages = [];
            $failedUploads = [];

            foreach ($request->file('images') as $index => $image) {
                try {
                    // Upload to ImageKit
                    $upload = ImageKitHelper::uploadImage(
                        $image, 
                        '/Zuppie/gallery',
                        Str::uuid()->toString()
                    );

                    if (!$upload) {
                        $failedUploads[] = [
                            'index' => $index,
                            'file' => $image->getClientOriginalName(),
                            'error' => 'Image upload failed'
                        ];
                        continue;
                    }

                    // Create gallery record
                    $galleryImage = GalleryImage::create([
                        'filename' => $upload['url'],
                        'file_id' => $upload['fileId'],
                        'alt' => $request->alt[$index] ?? null,
                        'category_id' => $request->category_id[$index] ?? null,
                        'description' => $request->description[$index] ?? null,
                    ]);

                    $uploadedImages[] = $galleryImage;
                } catch (\Exception $e) {
                    Log::error("Image upload error: " . $e->getMessage());
                    $failedUploads[] = [
                        'index' => $index,
                        'file' => $image->getClientOriginalName(),
                        'error' => $e->getMessage()
                    ];
                }
            }

            $response = [
                'success' => true,
                'message' => count($uploadedImages) . ' images uploaded successfully',
                'uploaded_images' => $uploadedImages,
            ];

            if (!empty($failedUploads)) {
                $response['failed_uploads'] = $failedUploads;
                $response['message'] .= ', ' . count($failedUploads) . ' failed';
            }

            return response()->json($response, 201);

        } catch (\Exception $e) {
            Log::error('Gallery store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred'
            ], 500);
        }
    }

    // Show single gallery image
    public function show($id)
    {
        try {
            $image = GalleryImage::with('category')->find($id);

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $image,
                'message' => 'Image retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Gallery show error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve image'
            ], 500);
        }
    }

    // Update gallery image
    public function update(Request $request, $id)
    {
        try {
            $image = GalleryImage::find($id);

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'alt' => 'nullable|string|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'description' => 'nullable|string',
                'new_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed'
                ], 422);
            }

            $data = $request->only(['alt', 'category_id', 'description']);

            // Handle image replacement
            if ($request->hasFile('new_image')) {
                $newImage = $request->file('new_image');
                $upload = ImageKitHelper::uploadImage(
                    $newImage, 
                    '/Zuppie/gallery',
                    Str::uuid()->toString()
                );

                if ($upload) {
                    // Delete old image from ImageKit
                    ImageKitHelper::deleteImage($image->file_id);
                    
                    $data['filename'] = $upload['url'];
                    $data['file_id'] = $upload['fileId'];
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload new image'
                    ], 500);
                }
            }

            $image->update($data);

            return response()->json([
                'success' => true,
                'data' => $image,
                'message' => 'Image updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Gallery update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update image'
            ], 500);
        }
    }

    // Delete gallery image
    public function destroy($id)
    {
        try {
            $image = GalleryImage::find($id);

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found'
                ], 404);
            }

            // Delete from ImageKit
            $deleteResult = ImageKitHelper::deleteImage($image->file_id);
            
            if (!$deleteResult) {
                Log::warning("ImageKit deletion failed for file ID: {$image->file_id}");
            }

            // Delete database record
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Gallery destroy error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image'
            ], 500);
        }
    }
}