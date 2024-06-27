<?php

namespace App\Http\Controllers;

use App\Models\Skillset;
use App\Models\ApplicantInformation;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as RulesPassword;

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
            'tools' => 'required|array',
            'tools.*' => 'string',
            'skills' => 'required|array',
            'skills.*' => 'string',
            'softskills' => 'array',
            'softskills.*' => 'string',
            'rate' => 'required',
            'portfolio' => 'required',
            'videolink' => 'required',
            'experience' => 'required',
            'resume' => 'required|mimes:pdf|max:10000',
            'disc_results' => 'required|mimes:pdf|max:10000',
            'skype' => 'required',
            'niche' => 'required',
            'ub_account' => 'required',
            'ub_number' => 'required',
            'photo_id' => 'required|max:10000',
            'photo_formal' => 'required|max:10000',
            'positions' => 'sometimes|array',
            'positions.*' => 'in:General Virtual Assistant, Social Media Manager,
                                Callers', 'Web Developers', 'Tech VAs', 'Project Manager',
        ]);

        $attributes = ['user_id' => Auth::id()];

        // Handle PDF file upload
        if ($request->hasFile('resume') && $request->hasFile('disc_results') && $request->hasFile('photo_id') && $request->hasFile('photo_formal') ) {

            $resumePdfPath = $request->file('resume')->store('pdfs', 'public');
            $discPdfPath = $request->file('disc_results')->store('DISC_Results', 'public');
            $formalPath = $request->file('photo_formal')->store('formals', 'public');
            $identificationPdfPath = $request->file('photo_id')->store('IDs', 'public');

        } else {
            return back()->with('error', 'Please upload a PDF file.');
        }

        $score = Skillset::firstOrNew($attributes);
        $score->website = json_encode($request->input('websites'));
        $score->tool = json_encode($request->input('tools'));
        $score->skill = json_encode($request->input('skills'));
        $score->softskill = json_encode($request->input('softskills'));
        $score->user_id = Auth::id();
        $score->save();

        $information = ApplicantInformation::firstOrNew($attributes);
        $information->rate = $request->input('rate');
        $information->videolink = $request->input('videolink');
        $information->portfolio = $request->input('portfolio');
        $information->experience = $request->input('experience');
        $information->positions = $request->input('positions');
        $information->skype = $request->input('skype');
        $information->niche = $request->input('niche');
        $information->ub_account = $request->input('ub_account');
        $information->ub_number = $request->input('ub_number');
        $information->resume = $resumePdfPath;
        $information->photo_id = $identificationPdfPath;
        $information->photo_formal = $formalPath;
        $information->disc_results = $discPdfPath;
        $information->user_id = Auth::id();
        $information->save();

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

        return back()->with('success', 'Form has been successfully filled-up! you can view your answers on by clicking "View account".');

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
            $websites = Skillset::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('website');

            $tools = Skillset::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('tool');

            $skills = Skillset::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('skill');

            $softskills = Skillset::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('softskill');

            $aWebsites = json_decode($websites);
            $aTools = json_decode($tools);
            $aSkills = json_decode($skills);
            $aSoftskills = json_decode($softskills);

        return view('user.show', compact('user',
                                        'aWebsites',
                                        'aTools',
                                        'aSkills',
                                        'aSoftskills'))->with('success', 'show here');

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
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->education = $request->input('education');
        $user->address = $request->input('address');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('user.show', $user->id)->with('success', 'Information successfully updated!');
    }

}
