<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // List only logged-in user's posts (for homepage/newsfeed)
    public function index()
    {
        $posts = Post::with('user')
            ->where('user_id', Auth::id()) // ✅ only show posts by the current user
            ->latest()
            ->get();

        return response()->json($posts);
    }

    // Store new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = $request->user()->posts()->create([
            'content' => $validated['content'],
        ]);

        // Optionally load user info
        $post->load('user');

        return response()->json($post, 201);
    }

    // Delete post (only owner can delete)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully!']);
    }
}
