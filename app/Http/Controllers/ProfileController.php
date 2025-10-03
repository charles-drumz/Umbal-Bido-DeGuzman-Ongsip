<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // GET /api/profile
    public function show()
    {
        $user = Auth::user();

        // Always append avatar_url for frontend
        $user->avatar_url = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('images/default-avatar.png');

        return response()->json($user);
    }

    // POST /api/profile
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'bio'        => 'nullable|string|max:1000',
            'email'      => 'sometimes|email|unique:users,email,' . $user->id,
            'address'    => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update basic fields
        $user->first_name = $validated['first_name'] ?? $user->first_name;
        $user->last_name  = $validated['last_name'] ?? $user->last_name;
        $user->bio        = $validated['bio'] ?? $user->bio;
        $user->email      = $validated['email'] ?? $user->email;
        $user->address    = $validated['address'] ?? $user->address;

        // Avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath; // Save as avatars/filename.ext
        }

        $user->save();

        // Always append avatar_url for frontend
        $user->avatar_url = $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('images/default-avatar.png');

        return response()->json([
            'message' => 'Profile updated successfully!',
            'user'    => $user,
        ]);
    }
}
