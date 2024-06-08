<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $user = User::findOrFail(Auth::id());

        return view('home', compact('user'));
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
            'websites' => 'required|array',
            'websites.*' => 'string',
            'applications' => 'required|array',
            'applications.*' => 'string',
            'tools' => 'required|array',
            'tools.*' => 'string',
            'skills' => 'required|array',
            'skills.*' => 'string',
            'softskills' => 'required|array',
            'softskills.*' => 'string',
        ]);

        // Create a new Score instance
        $scores = new Score();
        $scores->website = json_encode($request->input('websites'));
        $scores->application = json_encode($request->input('applications'));
        $scores->tool = json_encode($request->input('tools'));
        $scores->skill = json_encode($request->input('skills'));
        $scores->softskill = json_encode($request->input('softskills'));
        $scores->user_id = Auth::id();
        $scores->save();

        $tags = $request->only(['websites', 'applications', 'tools', 'skills', 'softskills']);

        // Flatten the array of tags
        $flattenedTags = [];
        foreach ($tags as $key => $value) {
            if (is_array($value)) {
                $flattenedTags = array_merge($flattenedTags, $value);
            } else {
                $flattenedTags[] = $value;
            }
        }

        return back()->with('success', 'Skillsets successfully added! you can view your answers on by clicking "View account".');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //show form
    public function show($id)
    {
            $user = User::findOrFail($id);
            $websites = Score::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('website');

            $applications = Score::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('application');

            $tools = Score::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('tool');

            $skills = Score::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('skill');

            $softskills = Score::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('softskill');

            $aWebsites = json_decode($websites);
            $aApplications = json_decode($applications);
            $aTools = json_decode($tools);
            $aSkills = json_decode($skills);
            $aSoftskills = json_decode($softskills);

        return view('user.show', compact('user', 'aWebsites', 'aApplications',
                                        'aTools', 'aSkills', 'aSoftskills'))->with('success', 'show here');

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'))->with('success', 'edit here');;
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
        //test
    }

}
