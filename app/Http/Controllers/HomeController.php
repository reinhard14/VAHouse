<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role_id) {
                case 1:
                case 2:
                    $response = redirect()->route('admin.dashboard');
                    break;
                case 3:
                    $response = redirect()->route('user.dashboard');
                    break;
                default:
                    $response = view('auth.login');
                    break;
            }

            return $response;

        } else {
            return view('auth.login');
        }
    }

}
