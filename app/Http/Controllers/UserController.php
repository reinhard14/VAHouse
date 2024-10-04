<?php

namespace App\Http\Controllers;

use App\Models\Skillset;
use App\Models\ApplicantInformation;
use App\Models\CallSample;
use App\Models\User;
use App\Models\Experience;
use App\Models\Reference;
use App\Models\UserFormCompletion;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password as RulesPassword;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        // $userForm = UserFormCompletion::findOrFail('user_id', $user);

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
        // Log the form data submission
        Log::info('Form submitted', [
            'user_id' => auth()->id(), // If user is authenticated
            'data' => $request->all(), // Logs all the form inputs
            'submitted_at' => now(), // Logs the time of submission
        ]);

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
            'experience' => 'required|gte:0',
            //pdfs
            'portfolio' => 'nullable|file|max:64000',
            'resume' => 'required|mimes:pdf|max:32000',
            'disc_results' => 'required|mimes:pdf|max:32000',
            //files
            'videolink' => 'required|mimes:mp4,avi,wmv|max:128000',
            'photo_id' => 'required|max:64000',
            'photo_formal' => 'required|max:64000',
            //applicant info
            'skype' => 'required',
            'niche' => 'required',
            'ub_account' => 'required',
            'ub_number' => 'required',
            'positions' => 'sometimes|array|min:1',
            'positions.*' => 'string',
        ],  [
            'videolink.required' => 'Video file is missing.',
            'videolink.mimes' => 'Video Introduction file type must be MP4.',
            'videolink.max' => 'Video file size exceed the 128000 MB limit!',

            'photo_id.required' => 'ID photo file is missing.',
            'photo_id.mimes' => 'ID photo must be an image file.',
            'photo_id.max' => 'ID photo file size exceed the 64 MB limit!',

            'photo_formal.required' => 'Formal Photo file is missing.',
            'photo_formal.mimes' => 'Formal Photo must be an image file.',
            'photo_formal.max' => 'Formal photo file size exceed the 64 MB limit!',

            'portfolio.max' => 'Portfolio file size exceed the 64 MB limit!',

            'resume.required' => 'Resume file is missing.',
            'resume.max' => 'Resume file size exceed the 32 MB limit!',

            'disc_results.required' => 'DISC Results file is missing.',
            'disc_results.max' => 'DISC results file size exceed the 32 MB limit!',
            ]);

        $user_id = Auth::id();
        $attributes = ['user_id' => $user_id];

        $userFormCompletion = UserFormCompletion::where('user_id', $user_id)->first();

        // Check if the hidden fields are not 1 (true/complete), non-existent or null.
        if (!isset($userFormCompletion->is_experience_completed, $userFormCompletion->is_reference_completed) ||
            $userFormCompletion->is_experience_completed != 1 ||
            $userFormCompletion->is_reference_completed != 1) {

            return redirect()->back()->withErrors([
                'message' => 'Both the experience and reference sections must be completed before saving.
                                Click "Expand" for adding experiences and "Click here" for references.',
            ]);

        }

        // Handle PDF file upload
        if ($request->hasFile('portfolio')) {
            $portfolioPath = $request->file('portfolio')->store('portfolios', 'public');
        } else {
            $portfolioPath = null;
        }

        if ($request->hasFile('resume') && $request->hasFile('disc_results') &&
            $request->hasFile('photo_id') && $request->hasFile('photo_formal') &&
            $request->hasFile('videolink')) {

            $resumePdfPath = $request->file('resume')->store('pdfs', 'public');
            $discPdfPath = $request->file('disc_results')->store('DISC_Results', 'public');
            $formalPath = $request->file('photo_formal')->store('formals', 'public');
            $identificationPdfPath = $request->file('photo_id')->store('IDs', 'public');
            $introVideoPdfPath = $request->file('videolink')->store('intro_videos', 'public');

        } else {
            return back()->with('error', 'Please upload a file.');
        }

        $skillset = Skillset::firstOrNew($attributes);
        $skillset->website = json_encode($request->input('websites'));
        $skillset->tool = json_encode($request->input('tools'));
        $skillset->skill = json_encode($request->input('skills'));
        $skillset->softskill = json_encode($request->input('softskills'));
        $skillset->user_id = Auth::id();
        $skillset->save();

        $information = ApplicantInformation::firstOrNew($attributes);
        $information->rate = $request->input('rate');
        $information->experience = $request->input('experience');
        $information->positions = json_encode($request->input('positions'));
        $information->skype = $request->input('skype');
        $information->niche = $request->input('niche');
        $information->ub_account = $request->input('ub_account');
        $information->ub_number = $request->input('ub_number');
        $information->resume = $resumePdfPath;
        $information->photo_id = $identificationPdfPath;
        $information->photo_formal = $formalPath;
        $information->disc_results = $discPdfPath;
        $information->videolink = $introVideoPdfPath;
        $information->portfolio = $portfolioPath;
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

        return redirect()->route('user.dashboard')->with('success', 'Form has been successfully filled-up! you can view your answers on by clicking "View account".');

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

            $positionsApplied = ApplicantInformation::where('user_id', $user->id)
                            ->latest('created_at')
                            ->value('positions');

            $aWebsites = json_decode($websites);
            $aTools = json_decode($tools);
            $aSkills = json_decode($skills);
            $aSoftskills = json_decode($softskills);
            $aPositionsApplied = json_decode($positionsApplied);


        return view('user.show', compact('user',
                                        'aWebsites',
                                        'aTools',
                                        'aSkills',
                                        'aSoftskills',
                                        'aPositionsApplied',)
                                        )->with('success', 'show here');

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
            'age' => 'required|gte:18|lte:60',
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
        $user->middlename = $request->input('middlename');
        $user->suffix = $request->input('suffix');
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

    public function experiences(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'duration' => 'required',
            'user_id' => 'required',
        ], [
            'title.required' => 'Job title is a required field.',
            'duration.required' => 'Duration of work a is required field.',
        ]);
        // dd($request->all()); // This will output the request data and stop execution
        // \Log::info($request->all());

        //ajax showing
        $exists = Experience::where('user_id', $request->input('user_id'))->exists();

        $experience = new Experience();
        $experience->title = $request->input('title');
        $experience->duration = $request->input('duration');
        $experience->user_id = $request->input('user_id');
        $experience->save();

        $attribute = ['user_id' => $request->input('user_id')];
        $formCompletion = UserFormCompletion::firstOrNew($attribute);
        $formCompletion->is_experience_completed = $request->input('is_experience_completed');
        $formCompletion->save();

        return response()->json([
            'success' => true,
            'message' => 'Experience has been saved successfully!',
            'experience' => $experience,
            'exists' => $exists,
        ]);
    }

    public function uploadMockcall(Request $request) {

        $this->validate($request, [
            'inbound_call' => 'required|mimes:mp4,avi,wmv,mp3,wav,aac,flac,ogg,wma|max:32000',
            'outbound_call' => 'required|mimes:mp4,avi,wmv,mp3,wav,aac,flac,ogg,wma|max:32000',
            'user_id' => 'required',
        ], [
            'inbound_call.required' => 'Inbound call file is missing.',
            'inbound_call.mimes' => 'Inbound call file type is incorrect.',
            'inbound_call.max' => 'Inbound call file size exceed the 32000 MB limit!',

            'outbound_call.required' => 'Outbound call file is missing.',
            'outbound_call.mimes' => 'Outbound call file type is incorrect.',
            'outbound_call.max' => 'Outbound call file size exceed the 32000 MB limit!',
        ]);

        $user_id = ['user_id' => Auth::id()];
        $callSample = CallSample::firstOrNew($user_id);

        if ($request->hasFile('inbound_call') && $request->hasFile('outbound_call')) {
            $inboundMockcallPath = $request->file('inbound_call')->store('mockcalls/inbounds', 'public');
            $outboundMockcallPath = $request->file('outbound_call')->store('mockcalls/outbounds', 'public');
        } else {
            return back()->with('error', 'Please upload a file.');
        }

        $callSample->inbound_call = $inboundMockcallPath;
        $callSample->outbound_call = $outboundMockcallPath;
        $callSample->user_id = $request->input('user_id');
        $callSample->save();

        return response()->json([
            'success' => true,
            'message' => 'Mock calls has been saved!',
            'mockcalls' => $callSample,

        ]);
    }

    public function storeReferences(Request $request)
    {
        $this->validate($request, [
            'emergency_person' => 'required',
            'emergency_relationship' => 'required',
            'emergency_number' => 'required',
            'start_date' => 'required',
            'department' => 'required',
            'team_leader' => 'required',
            'referral' => 'required',
            'preferred_shift' => 'required',
            'work_status' => 'required',
            'services_offered' => 'required|array',
            'user_id' => 'required',
        ], [
            'emergency_person.required' => 'Please enter the name of emergency person.',
            'emergency_relationship.required' => 'Please enter the relationship with the person.',
            'emergency_number.required' => 'Please enter the number of the person.',
            'start_date.required' => 'Kindly select a date of commencement.',
            'department.required' => 'Please add the department/client you belong.',
            'team_leader.required' => 'Please add the team leader/client you belong.',
            'referral.required' => 'Please select where you heard from us.',
            'preferred_shift.required' => 'Please select preferred working shift.',
            'work_status.required' => 'Select work status.',
            'services_offered.required' => 'Please select services offered from the choices.',
        ]);

        $userId = Auth::id();
        $id = ['user_id' => $userId];
        $reference = Reference::firstOrNew($id);
        $reference->emergency_person = $request->input('emergency_person');
        $reference->emergency_relationship = $request->input('emergency_relationship');
        $reference->emergency_number = $request->input('emergency_number');
        $reference->start_date = $request->input('start_date');
        $reference->department = $request->input('department');
        $reference->team_leader = $request->input('team_leader');
        $reference->referral = $request->input('referral');
        $reference->preferred_shift = $request->input('preferred_shift');
        $reference->work_status = $request->input('work_status');
        $reference->services_offered = $request->input('services_offered');
        $reference->user_id = $userId;
        $reference->save();

        // $attribute = ['user_id' => $id];
        $attribute = ['user_id' => $request->input('user_id')];
        $formCompletion = UserFormCompletion::firstOrNew($attribute);
        $formCompletion->is_reference_completed = $request->input('is_reference_completed');
        $formCompletion->save();

        return redirect()->route('user.dashboard')->with('success', 'Additional references has been saved.');
    }

    public function destroyExperience($id)
    {
        $experience = Experience::find($id);
        $experience->delete();
        $userId = Auth::id();

        return redirect()->route('user.show', $userId);
    }

}
