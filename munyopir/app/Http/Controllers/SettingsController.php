<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountPasswordRequest;
use App\Http\Requests\UpdateAccountProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SettingsController extends Controller
{
    public function profilePhoto(Request $request): StreamedResponse
    {
        $photoPath = $request->user()->profile_photo_path;
        abort_if($photoPath === null, 404);

        $disk = Storage::disk('local');
        abort_unless($disk->exists($photoPath), 404);

        $contentType = $disk->mimeType($photoPath) ?? 'application/octet-stream';
        abort_unless(in_array($contentType, ['image/jpeg', 'image/png', 'image/webp'], true), 404);

        $stream = $disk->readStream($photoPath);
        if ($stream === false) {
            throw new RuntimeException('Foto profil gagal dibaca.');
        }

        return response()->stream(function () use ($stream): void {
            try {
                if (fpassthru($stream) === false) {
                    throw new RuntimeException('Foto profil gagal dikirim.');
                }
            } finally {
                fclose($stream);
            }
        }, 200, [
            'Cache-Control' => 'private, no-store',
            'Content-Disposition' => 'inline; filename="'.basename($photoPath).'"',
            'Content-Type' => $contentType,
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function updateProfile(UpdateAccountProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        $profilePhoto = $validated['profile_photo'] ?? null;
        unset($validated['profile_photo']);

        if ($profilePhoto !== null) {
            $profilePhotoPath = $profilePhoto->store('profile-photos', 'local');

            if ($profilePhotoPath === false) {
                throw new RuntimeException('Foto profil gagal disimpan.');
            }

            $validated['profile_photo_path'] = $profilePhotoPath;
        }

        $previousProfilePhotoPath = $user->profile_photo_path;
        $user->update($validated);

        if ($profilePhoto !== null && $previousProfilePhotoPath !== null && ! Storage::disk('local')->delete($previousProfilePhotoPath)) {
            throw new RuntimeException('Foto profil lama gagal dihapus.');
        }

        return back()->with('status', 'Informasi akun berhasil diperbarui.');
    }

    public function updatePassword(UpdateAccountPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return back()->with('status', 'Kata sandi berhasil diperbarui.');
    }
}
