<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    /**
     * Get paginated list of users
     */
    public function index(Request $request)
    {
        // Basic validation
        $request->validate([
            'search' => 'sometimes|string|max:255',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ]);

        // Get parameters with defaults
        $search = $request->input('search', '');
        $perPage = $request->input('per_page', 5);

        // Query users
        $users = User::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone_no', 'like', '%'.$search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Return basic user data
        return response()->json($users);
    }

    /**
     * Get single user
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json($user);
    }
}