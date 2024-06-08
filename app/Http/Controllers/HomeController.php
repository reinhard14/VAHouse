<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function dashboard()
    {
        $departments = Department::all();
        $users = User::where('role_id', '>', 1)->get();
        $admins =  $users->where('role_id', 2);
        $agents =  $users->where('role_id', 3);

        // Calculate the start and end dates of one week ago
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now();

        // Query users created exactly one week ago
        $recentUsers = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->get();


        return view('index', compact('departments',
                                    'users',
                                    'admins',
                                    'agents',
                                    'recentUsers'));
    }
}
