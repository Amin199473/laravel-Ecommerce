<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Order;
use App\Models\Profile;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mywishlists = WishList::where('user_id', $user->id)->get();
        $orders = Order::where('user_id', $user->id)->withTrashed()->latest()->get();
        return view('frontend.userProfile.index', compact('user', 'orders', 'mywishlists'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $rules = [
            'name' => 'required|min:3',
            'email' =>  [
                'required',
                'email:rfc,dns,filter',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'job' => 'nullable|min:3',
            'password' => 'nullable|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
            'experince' => 'nullable|min:3',
            'bio' => 'nullable|min:3',
            'skill' => 'nullable|min:3',
        ];
        $customMessages = [
            'name.required' => 'The name field must be at least 3 characters',
            'email.required' => 'The email field must be unique and email formt.',
            'job.min:3' => 'The job field must be at least 3 characters',
            'password.regex' => 'The Password Consis of English uppercase characters (A – Z) and lowercase characters (a – z) and Base 10 digits (0 – 9) and Non-alphanumeric (For example: !, $, #, or %) Unicode characters',
            'experince.min:3' => 'The experince field must be at least 3 characters',
            'bio.min:3' => 'The bio field must be at least 3 characters',
            'skill.min:3' => 'The skill field must be at least 3 characters',
        ];
        $this->validate($request, $rules, $customMessages);
        if ($request->hasFile('avatar')) {
            //unlink old Images in public path
            $path = 'avatar-image/' . $user->profile->avatar;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            $photo = $request->file('avatar');
            $filename = 'avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('avatar-image/');
            $request->file('avatar')->move($location, $filename);
        }
        $user->update([
            'name' => isset($request->name) ? $request->name : $user->name,
            'email' => isset($request->email) ? $request->email : $user->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
        ]);

        $profile = Profile::where('id', $user->id)->first();
        $profile->update([
            'avatar' => isset($filename) ? $filename : $profile->avatar,
            'job' => $request->job,
            'experince' => $request->experince,
            'bio' => $request->bio,
            'skill' => $request->skill,
        ]);
        return redirect()->route('userProfile')->with('success', 'your Profile Updated Successfully!');
    }


    public function updateAddressProfile(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('id', $user->id)->first();
        $rules = [
            'address' => 'nullable|min:3',
            'city' => 'nullable|min:3',
            'province' => 'nullable|min:3',
            'country' => 'nullable|min:3',
        ];
        $customMessages = [
            'address.min:3' => 'The address field must be at least 3 characters',
            'city.min:3' => 'The city field must be at least 3 characters',
            'province.min:3' => 'The province field must be at least 3 characters',
            'country.min:3' => 'The country field must be at least 3 characters',
        ];
        $this->validate($request, $rules, $customMessages);
        $profile->update([
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'country' => $request->country,
        ]);
        return redirect()->route('userProfile')->with('success', 'your Profile Updated Successfully!');
    }
}