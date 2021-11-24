<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at,
            'password' => Hash::make($request->password)
        ]);

        Profile::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'dateOfBirth' => $request->dateOfBirth
        ]);

        if ($request->role != null) {
            $user->syncRoles($request->role);
        }
        if ($request->permissions != null) {
            $user->syncPermissions($request->permissions);
        }

        return redirect()->back()->with('success', 'user Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.update', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user->profile->gender);
        $rules = [
            'name' => 'required|min:3',
            'email' =>  [
                'required',
                'email:rfc,dns,filter',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'password' => 'nullable|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
            'role' => 'required',
        ];
        $customMessages = [
            'name.required' => 'The title field must be at least 3 characters',
            'email.required' => 'The email field must be unique and email formt.',
            'dateOfBirth.required' => 'please select date of birth',
            'password.regex' => 'The Password Consis of English uppercase characters (A – Z) and lowercase characters (a – z) and Base 10 digits (0 – 9) and Non-alphanumeric (For example: !, $, #, or %) Unicode characters',
            'role.required' => 'please select an role',
        ];
        $this->validate($request, $rules, $customMessages);


        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $profile = Profile::where('user_id', $user->id)->first();
        $profile->gender = $request->gender;
        $profile->dateOfBirth = $request->dateOfBirth;
        $profile->save();

        $user->roles()->detach();
        $user->permissions()->detach();
        $role = Role::where('name', $request->role);
        if ($request->role != null) {
            $role = Role::where('name', $request->role)->first();
            $user->syncRoles($request->role);
        }

        if ($request->permissions != null) {
            $role->syncPermissions($request->permissions);
            $user->syncPermissions($request->permissions);
        }

        return redirect()->back()->with('success', 'user Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach(); //detach roles of the user
        $user->permissions()->detach(); //detach Permissions of the user
        $user->delete(); //delete  the user
        return redirect()->back()->with('success', 'User Deleted Succefully');
    }

    public function deleteAll()
    {
        $users = User::get();
        if (!$users->isEmpty()) {
            foreach ($users as $user) {
                $user->delete();
            }
            return redirect()->back()->with('success', 'All Users deleted succesfully');
        } else {
            return redirect()->back()->with('failed', 'There is none User for delete');
        }
    }
}