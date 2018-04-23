<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;

use App\User;
use Auth;

//Importing laravel-permission models
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

//Enables us to output flash messaging
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UsersDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index', ['title' => 'admin users', 'roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $validatedData = $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            if ($validatedData['avatar'] != null) {
                $imageName = time() . '.' . request()->avatar->getClientOriginalExtension();
                request()->avatar->move(public_path('images'), $imageName);
                $validatedData['avatar_url'] = '/images/' . $imageName;
            }
            $user = User::create($validatedData); //Retrieving only the email and password data

            $roles = $request['roles']; //Retrieving the roles field
            //Checking if a role was selected
            if (isset($roles)) {
                foreach ($roles as $roleId) {
                    $role_r = Role::findById($roleId);
                    $user->assignRole($role_r); //Assigning role to user
                }
            }
            DB::commit();
            app()['cache']->forget('spatie.permission.cache');
            //Redirect to the users.index view and display message
            return redirect()->route('users.index')
                ->with('flash_message',
                    'User successfully added.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->withErrors('Error While creating this user please contact developers');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        DB::beginTransaction();
        try {

            if (array_key_exists('avatar', $validatedData) && $validatedData['avatar'] != null) {
                $imageName = time() . '.' . request()->avatar->getClientOriginalExtension();
                request()->avatar->move(public_path('images'), $imageName);
                $validatedData['avatar_url'] = '/images/' . $imageName;
            }
            $roles = $request['roles'];
            if (!$validatedData['password']) unset($validatedData['password']);
            $user->fill($validatedData)->save();

            if (isset($roles)) {
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
            } else {
                $user->roles()->detach(); //If no role is selected remove existing role associated to a user
            }
            DB::commit();
            app()['cache']->forget('spatie.permission.cache');
            return redirect()->route('users.index')
                ->with('flash_message',
                    'User successfully edited.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->withErrors('Error occurs While editing this user, please contact developers');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();
        app()['cache']->forget('spatie.permission.cache');
        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully deleted.');
    }
}