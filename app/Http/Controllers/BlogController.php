<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ImageKit\ImageKit;
class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $blogs = $query->latest()->paginate($request->input('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $blogs
        ]);
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($validated['title']);
        $validated['slug'] = $slug;

        // Handle image upload via ImageKit
        if ($request->hasFile('image')) {
            $uploadResult = $this->uploadToImageKit($request->file('image'));
            if ($uploadResult) {
                $validated['image'] = $uploadResult['url'];
                $validated['image_file_id'] = $uploadResult['fileId'];
            }
        }

        $validated['user_id'] = auth()->id();

        $blog = Blog::create($validated);

        return response()->json([
            'success' => true,
            'data' => $blog,
            'message' => 'Blog created successfully'
        ], 201);
    }

    /**
     * Display the specified blog
     */
    public function show(Blog $blog)
    {
        return response()->json([
            'success' => true,
            'data' => $blog
        ]);
    }

    /**
     * Update the specified blog
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $blog->id,
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Handle image upload via ImageKit
        if ($request->hasFile('image')) {
            $uploadResult = $this->uploadToImageKit($request->file('image'));
            if ($uploadResult) {
                $validated['image'] = $uploadResult['url'];
                $validated['image_file_id'] = $uploadResult['fileId'];
            }
        }

        $blog->update($validated);

        return response()->json([
            'success' => true,
            'data' => $blog,
            'message' => 'Blog updated successfully'
        ]);
    }

    /**
     * Remove the specified blog
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully'
        ], 204);
    }

    /**
     * Upload image to ImageKit
     */
    private function uploadToImageKit($image)
    {
        $publicKey = config('imagekit.public_key', env('IMAGEKIT_PUBLIC_KEY'));
        $privateKey = config('imagekit.private_key', env('IMAGEKIT_PRIVATE_KEY'));
        $urlEndpoint = config('imagekit.url_endpoint', env('IMAGEKIT_URL_ENDPOINT'));

        if (empty($publicKey) || empty($privateKey) || empty($urlEndpoint)) {
            return null;
        }

        $imagekit = new ImageKit($publicKey, $privateKey, $urlEndpoint);

        $localPath = $image->getRealPath();
        $fileName = $image->getClientOriginalName();

        $fileResource = fopen($localPath, 'r');
        if ($fileResource === false) {
            return null;
        }

        try {
            $response = $imagekit->upload([
                'file' => $fileResource,
                'fileName' => $fileName,
                'folder' => '/Blogs/',
                'useUniqueFileName' => true,
            ]);
        } finally {
            if (is_resource($fileResource)) {
                fclose($fileResource);
            }
        }

        if (isset($response->result) && !empty($response->result->url)) {
            return [
                'url' => $response->result->url,
                'fileId' => $response->result->fileId
            ];
        }

        return null;
    }
}
