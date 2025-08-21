<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Administrator;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as RulesPassword;


class AdministratorController extends Controller
{

    /**
     * Display the dashboard for administrator's account.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // user roles
        $SUPERADMIN = 1;
        $ADMIN = 2;
        $AGENTS = 3;

        $departments = Department::all();

        $users = User::where('role_id', '>', $SUPERADMIN)->get();
        $admins =  $users->where('role_id', $ADMIN);
        $agents =  $users->where('role_id', $AGENTS);

        $levels = [
            'Beginner' => 2,
            'Intermediate' => 5,
            'Seasoned' => 6,
            'All' => 0,
        ];

        $latestUsers = User::where('role_id', $AGENTS)->latest()->take(6)->get();

        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfLastWeek = Carbon::now();

        // Query users created exactly one week ago
        $lastMonthUsers = User::whereBetween('created_at', [$startOfLastMonth, $startOfMonth])->get();
        $currentMonthUsers = User::whereBetween('created_at', [$startOfMonth, $endOfLastWeek])->get();

        $currentMonthPercentage = $currentMonthUsers->count() && $lastMonthUsers->count() > 0
            ? round(((($currentMonthUsers->count() - $lastMonthUsers->count()) / $lastMonthUsers->count()) * 100), 2)
            : 0;

        return view('index', compact('departments',
                                    'users',
                                    'admins',
                                    'agents',
                                    'lastMonthUsers',
                                    'levels',
                                    'latestUsers',
                                    'currentMonthUsers',
                                    'currentMonthPercentage'
                                ));
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
            'contactnumber' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'email' => ['required', 'email', 'unique:users'],
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
        $user->contactnumber = $request->input('contactnumber');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->education = $request->input('education');
        $user->address = $request->input('address');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 2;
        $user->save();

        //after creating user ID, we can use it's ID.
        $user_id = $user->id;

        //new admin
        $administrator = new Administrator();
        $administrator->department = $request->input('department');
        $administrator->position = $request->input('position');
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

    public function editMyInformation($id)
    {
        $departments = Department::all();
        $administrator = User::findOrFail(Auth()->id());

        return view('administrator.my-information', compact('administrator', 'departments'));
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
        $user = Administrator::find($id);
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'contactnumber' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->user_id),
            ],
            'department' => 'required',
            'password' => ['nullable',
                        RulesPassword::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                    ]
        ]);

        $administrator = Administrator::find($id);
        $administrator->department = $request->input('department');
        $administrator->position = $request->input('position');
        $administrator->save();

        $user_id = $administrator->user_id;

        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->contactnumber = $request->input('contactnumber');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->education = $request->input('education');
        $user->address = $request->input('address');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        // $user->password = bcrypt($request->input('password'));
        $user->save();

        if($request->input('saving_option') === 'save_and_exit') {
            return redirect()->route('administrator.index')->with('success', 'Administrator information successfully edited.');
        } else {
            return redirect()->route('administrator.show', compact('administrator'))->with('success', 'Administrator information successfully edited.');
        }
    }
    public function updateMyInformation(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        // dd($user);
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'contactnumber' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'department' => 'required',
            'password' => ['nullable',
                        RulesPassword::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                    ]
        ]);

        $administrator = Administrator::where('user_id', $id)->firstOrFail();
        $administrator->department = $request->input('department');
        $administrator->position = $request->input('position');
        $administrator->save();

        // $user_id = $administrator->user_id;

        // $user = User::find($id);
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->contactnumber = $request->input('contactnumber');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->education = $request->input('education');
        $user->address = $request->input('address');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        // $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Your information has been successfully updated.');

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

        $user_id = $administrator->user_id;
        $user = User::find($user_id);
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

    public function viewPDF($filename)
    {
        $filePath = 'pdfs/' . $filename;

        // Check if the file exists
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404);
        }

        // Get the file's content
        $fileContent = Storage::disk('public')->get($filePath);

        // Return the file's content as a response
        return response($fileContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

}
