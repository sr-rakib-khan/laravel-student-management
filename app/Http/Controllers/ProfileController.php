<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->admin_name;
        $user->email = $request->admin_email;
        $user->user_name = $request->user_name;
        $user->phone = $request->admin_phone;
        $user->update();

        $notification = array('message' => 'User Info Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    function Passwordupdate(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);


        $user = auth()->user();

        //    password check
        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array('message' => 'Old Password is not corrcet!', 'alert-type' => 'error');

            return redirect()->back()->with($notification);
        }

        // pasword make hash 
        $user->password = Hash::make($request->new_password);

        $password_update = User::find($user->id);
        $password_update->password = Hash::make($request->new_password);

        Auth::logout();

        $notification = array('message' => 'Password Changed!', 'alert-type' => 'success');

        return Redirect()->route('admin.logout')->with($notification);
    }

    function ChangeProfilePhoto(Request $request)
    {
        $user = User::find(auth()->id());
        //working for photo
        if ($request->admin_photo) {

            if (File::exists($request->old_photo)) {
                unlink($request->old_photo);
            }

            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $photo = $request->admin_photo;
            $photo_name = $slug . "." . $photo->getClientOriginalExtension();
            $photo_read = $manager->read($photo);
            $photo_resize = $photo_read->resize(300, 300)->save('assets/admin/' . $photo_name);
            $user->photo = 'assets/admin/' . $photo_name;
        } else {
            $user->photo = $request->old_photo;
        }
        $user->save();

        $notification = array('message' => 'Profile Photo Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    function Adminlogout()
    {
        return redirect()->route('login');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
