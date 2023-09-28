<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;

class CustomerController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('customer.account.show', [
            'user' => $user,
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->validated();

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = config('app.gender.' . $request->gender);
        $user->email = $request->email;

        if ($request->hasFile('avatar_image')) {
            $uploadedFile = $request->file('avatar_image');
            $filename = $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs('avatars', $filename, 'public');
            $fileUrl = Storage::url("avatars/{$filename}");

            $currentImage = $user->image;
            if ($currentImage) {
                if ($currentImage->image_url != config('app.default_image.user')) {
                    $path = $currentImage->image_url;
                    $path = str_replace('/storage', '', $path);
                    Storage::disk('public')->delete($path);
                }

                $currentImage->image_url = $fileUrl;
                $currentImage->save();
            } else {
                $user->image()->create([
                    'image_url' => $fileUrl,
                ]);
            }
        }

        $user->save();

        alert()->success(__('Success'), __("Your account's profile information has been updated!"));

        return redirect()->back();
    }

    public function editPassword()
    {
        return view('customer.password.edit');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->validated();

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            alert()->success(__('Success'), __('Your password has been updated!'));

            return redirect()->route('customer.profile.show');
        } else {
            return redirect()->back()->withErrors([
                'current_password' => __('The provided password does not match your current password.')
            ]);
        }
    }
}
