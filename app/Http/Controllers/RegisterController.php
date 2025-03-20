<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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


    public function personalInformation() {
        return view('auth.register.personal-info');
    }

    public function personalInformationPost(Request $request) {

        $request->validate([
            'name' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
        ]);

        // Store in session
        Session::put('register_data.name', $request->name);
        Session::put('register_data.middlename', $request->middlename);
        Session::put('register_data.lastname', $request->lastname);
        Session::put('register_data.suffix', $request->suffix);
        Session::put('register_data.gender', $request->gender);

        return redirect()->route('register.account');
    }

    public function account() {
        // Retrieve session data, for debugging purposes on prior forms.
        // $data = Session::get('register_data');
        // dd($data);

        return view('auth.register.account');
    }

    public function accountPost(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => ['required', 'confirmed'],
            'captcha' => ['required', 'captcha'],
        ]);

        // Retrieve session data
        $data = Session::get('register_data', []);

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'suffix' => $data['suffix'],
            'gender' => $data['gender'],
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => $request->input('role_id'),
            //this needed to be migrated tables.
            'contactnumber' => '',
            'age' => '',
            'address' => '',
            'education' => '',

        ]);

        // Clear session data
        Session::forget('register_data');

        // Log the user in
        Auth::login($user);

        // Redirect user to intended page
        return redirect(RouteServiceProvider::HOME);

    }


    public function verify() {
        return view('auth.register.verify');
    }
}
