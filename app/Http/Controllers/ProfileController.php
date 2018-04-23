<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('users.profile', ['title' => 'Edit My Profile']);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6|confirmed',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        DB::beginTransaction();
        try {
            if (array_key_exists('avatar', $validatedData) && $validatedData['avatar'] != null) {
                $imageName = time() . '.' . request()->avatar->getClientOriginalExtension();
                request()->avatar->move(public_path('images'), $imageName);
                $validatedData['avatar_url'] = '/images/' . $imageName;
            }
            $user->fill($validatedData)->save();
            DB::commit();
            return redirect()->route('profile.edit')
                ->with('flash_message',
                    'User successfully edited.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('profile.edit')->withErrors('Error occurs While editing your profile, please contact developers');
        }
    }


}