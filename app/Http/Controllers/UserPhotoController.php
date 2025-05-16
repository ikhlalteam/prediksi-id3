<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserPhotoController extends Controller
{
    public function update(Request $request)
{
    $request->validate([
        'photo' => ['required', 'image', 'max:2048'],
    ]);

    $user = Auth::user();

    if ($user->profile_photo_path) {
        Storage::delete('public/' . $user->profile_photo_path);
    }

    $path = $request->file('photo')->store('profile-photos', 'public');

    $user->profile_photo_path = $path;
    $user->save();

    return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
}

}
