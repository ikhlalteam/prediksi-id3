<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prediksi;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class ProfileController extends Controller
{
    // ✅ Menampilkan halaman edit profil
    public function edit()
    {
        $riwayat = Prediksi::where('user_id', Auth::id())->latest()->get();
        return view('profile.edit', compact('riwayat'));
    }

    // ✅ Menyimpan perubahan profil
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'email' => 'required|email',
        'password' => 'nullable|string|min:6',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        $file = $request->file('photo');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'profile-photos/' . $filename;

        // ✅ Resize gambar ke 300x300 px dan simpan ke storage
        $image = Image::make($file)->fit(300, 300);
        Storage::put('public/' . $path, (string) $image->encode());

        $user->profile_photo_path = $path;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
}


    // ✅ Menghapus akun
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }

    


}

