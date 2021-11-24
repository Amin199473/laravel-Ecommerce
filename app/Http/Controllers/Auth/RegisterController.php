<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dateOfBirth' => ['required'],
            'gender' => ['required'],
            'password' => ['regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'min:8', 'confirmed', 'required'],
        ], [
            'name.required' => 'The title field must be at least 3 characters',
            'email.required' => 'The email field must be unique and email formt.',
            'dateOfBirth.required' => 'please select date of birth',
            'gender.required' => 'please select one gender',
            'password.regex' => 'The Password Consis of English uppercase characters (A – Z) and lowercase characters (a – z) and Base 10 digits (0 – 9) and Non-alphanumeric (For example: !, $, #, or %) Unicode characters',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        //assign defualt role to new users
        $role = Role::where('name', '=', 'user')->get();
        if ($role->isEmpty()) {
            $role = Role::create(['name' => 'user']);
        }
        $user->assignRole('user');

        Profile::create([
            'user_id' => $user->id,
            'gender' => $data['gender'],
            'dateOfBirth' => $data['dateOfBirth'],
        ]);

        $users = User::get();
        foreach ($users as $user) {
            if ($user->hasAnyRole('super-admin|admin')) {
                $user->notify(new NewUser('new user registered'));
            }
        }
        return $user;
    }
}