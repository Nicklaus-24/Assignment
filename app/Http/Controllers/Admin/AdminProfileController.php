<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends AdminBaseController
{
    public function create()
    {
        return view('pages.adminprofile');
    }

    public function update()
    {
        $admin = auth()->guard('admin')->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'firstname' => 'required',
            'lastname'=>'required',
            'avatar' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);

        // Check if a new profile picture is being uploaded
    if (request()->hasFile('avatar')) {
        // Delete the previous profile picture, if any
        if ($admin->avatar) {
            Storage::delete($admin->avatar);
        }

        // Upload and store the new profile picture
        $path = request()->file('avatar')->store('public/profile_images');
        $attributes['avatar'] = $path;
    }
        $admin->update($attributes);
        return back()->withStatus('Profile successfully updated.');
    }
}  
