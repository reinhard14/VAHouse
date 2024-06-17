<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password as RulesPassword;



class AdminUserController extends Controller
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
    public function index(Request $request)
    {

        // Check if sorting parameter exists in the URL
        $sortByLastname = $request->query('sortByLastname');
        $sortByFirstname = $request->query('sortByFirstname');
        $sortByDateSubmitted = $request->query('sortByDateSubmitted');

        $sortByColumn = 'lastname';
        $sortOrder = 'asc';

        if ($sortByFirstname) {
            $sortByColumn = 'name';

        }
        if ($sortByDateSubmitted) {
            $sortByColumn = 'created_at';
        }
        // Determine sorting order based on the parameter (asc or desc)
        $sortOrder = ($sortByLastname === 'desc' || $sortByFirstname === 'desc' || $sortByDateSubmitted === 'desc') ? 'desc' : 'asc';

        $toggleSortLastname = $this->sortOrder($sortByLastname);
        $toggleSortFirstname = $this->sortOrder($sortByFirstname);
        $sortByDateSubmitted = $this->sortOrder($sortByDateSubmitted);

        $usersQuery = User::where('role_id', 3)
                        ->leftJoin('scores', 'users.id', '=', 'scores.user_id')
                        ->select('users.*', 'scores.*')
                        ->distinct()
                        ->orderBy($sortByColumn, $sortOrder);

        // Searching
        if ($search = $request->query('search')) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.lastname', 'like', '%' . $search . '%');
            });
        }

        // Get the selected tags from the request
        $filters = [
            'websites' => 'scores.website',
            'tools' => 'scores.tool',
            'skills' => 'scores.skill',
            'softskills' => 'scores.softskill',
            'experience' => 'scores.experience',
        ];

        // Apply tag filters
        foreach ($filters as $inputField => $dbField) {
            if ($tags = $request->input($inputField, [])) {
                $usersQuery->where(function ($query) use ($tags, $dbField) {
                    foreach ($tags as $tag) {
                        if (is_numeric($tag)) {
                            $query->orWhere($dbField, '=', $tag);
                        } else {
                            $query->orWhere($dbField, 'like', '%' . $tag . '%');
                        }
                    }
                });
            }
        }

        // Get the results with pagination
        $users = $usersQuery->select('users.*')->paginate(12);

        // Append sorting parameters to pagination links
        $users->appends(['sortByLastname' => $sortByLastname, 'sortByFirstname' => $sortByFirstname, 'sortByDateSubmitted' => $sortByDateSubmitted]);

        // Display data on FILTERS
        $scores = Score::all();

        // Helper function to get unique values from a JSON field
        function getUniqueValues($scores, $field) {
            return $scores->pluck($field)
                        ->map(function($item) {
                            return json_decode($item, true);
                        })
                        ->flatten()
                        ->unique()
                        ->values()
                        ->all();
        }

        // Get unique values for each field
        $uniqueWebsites = getUniqueValues($scores, 'website');
        $uniqueTools = getUniqueValues($scores, 'tool');
        $uniqueSkills = getUniqueValues($scores, 'skill');
        $uniqueSoftskills = getUniqueValues($scores, 'softskill');
        $uniqueExperience = getUniqueValues($scores, 'experience');

        return view('admin-users.index', compact(
            'users',
            'sortByLastname',
            'sortByFirstname',
            'toggleSortLastname',
            'toggleSortFirstname',
            'sortByDateSubmitted',
            'uniqueWebsites',
            'uniqueExperience',
            'uniqueTools',
            'uniqueSkills',
            'uniqueSoftskills',
        ));

    }

    private function sortOrder($sortBy) {
        return ($sortBy === 'desc') ? 'desc' : 'asc';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //used modal component.
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
            'email' => 'required',
            'contactnumber' => 'required',
            'password' => ['required',
            RulesPassword::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'role_id' => 'required',
        ]);

        $user = New User;
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->contactnumber = $request->input('contactnumber');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $skillset = Score::where('user_id', $user->id )
                        ->latest()
                        ->first();

        return view('admin-users.show', compact('user',
                                                'skillset',
                                        ));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin-users.edit', compact('user', 'forms'));
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
            'password' => ['required',
                        RulesPassword::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()],
        ]);
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->contactnumber = $request->input('contactnumber');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.users.index');

    }

    public function destroySelected(Request $request)
    {
        $selectedUserIds = explode(',', $request->input('selectedUserIds'));

        foreach($selectedUserIds as $userId) {
            $user = User::find($userId);
            $user->delete();
        }

        return redirect()->route('admin.users.index');
    }
}
