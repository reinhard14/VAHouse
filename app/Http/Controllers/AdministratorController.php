<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as RulesPassword;


class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = Administrator::where('role_id', 2)->paginate(10);
        // $db = DB::table('administrators')->get();
        return view('administrator.index', compact('administrators'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('administrator.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'email' => ['required', 'email'],
            'department' => 'required',
            'password' => ['required',
                        RulesPassword::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()]
        ]);

        //create user type
        $user = new User();

        //get form data
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 2;
        // $user->administrator_id = $user->id;
        $user->save();

        //after creating user ID we can use it's ID.
        $user_id = $user->id;
        //new admin
        $administrator = new Administrator();

        //get form data
        $administrator->department = $request->input('department');
        $administrator->position = $request->input('position');
        $administrator->gender = $request->input('gender');
        $administrator->user_id = $user_id;
        $administrator->role_id = 2;

        $administrator->save();

        if($request->input('saving_option') == 'save_and_exit') {
            return redirect()->route('administrator.index');
        } else {
            return redirect()->route('administrator.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $administrator = Administrator::find($id);
        return view('administrator.show', compact('administrator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $administrator = Administrator::find($id);
        return view('administrator.edit', compact('administrator', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'email' => ['required', 'email'],
            'department' => 'required',
            'password' => ['required',
                        RulesPassword::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()]
        ]);

        $administrator = Administrator::find($id);

        $administrator->department = $request->input('department');
        $administrator->position = $request->input('position');
        $administrator->gender = $request->input('gender');

        $administrator->save();

        $user_id = $administrator->user_id;
        $user = User::find($user_id);

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        if($request->input('saving_option') === 'save_and_exit') {
            return redirect()->route('administrator.index');
        } else {
            return redirect()->route('administrator.show', compact('administrator'));
        }
        // return view('administrator.show', compact('administrator'))->with('success', 'Info Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $administrator = Administrator::find($id);
        $administrator->delete();

        $user = User::find($id);
        $user->delete();

        return redirect()->route('administrator.index');
    }

    public function destroySelected(Request $request)
    {

        $selectedAdminIds = explode(',', $request->input('selectedAdminIds'));

        foreach($selectedAdminIds as $adminId) {
            $administrator = Administrator::find($adminId);
            $administrator->delete();
        }

        return redirect()->route('administrator.index');
    }

}
