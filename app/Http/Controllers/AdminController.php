<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function viewUsers()
    {
        $users = User::where('email', '!=', 'admin@yopmail.com')->get();
        return view('users_list', compact('users'));
    }

    public function editUser(User $user)
    {
        // dd($user);
        return view('update_user', compact('user'));
    }


    public function updateUser(Request $request, User $user)
    {
        // dd($request->all(), $request->files->all());

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('profile_photo')) {
            // dd('File uploaded:', $request->file('profile_photo'));
            // Delete old image if exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new image
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }
        // dd('Data to update:', $data);

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function toggleUserStatus(Request $request, User $user)
    {
        // dd('Toggle status for user:', $user);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->update();
        return response()->json(['status' => true, 'message' => 'User status updated successfully']);
    }


}
