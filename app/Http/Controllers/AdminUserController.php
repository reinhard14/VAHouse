<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInformation;
use App\Models\CallSample;
use App\Models\Experience;
use App\Models\Review;
use App\Models\Skillset;
use App\Models\Status;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        } elseif ($sortByDateSubmitted) {
            $sortByColumn = 'created_at';
        }
        // Determine sorting order based on the parameter (asc or desc)
        $sortOrder = ($sortByLastname === 'desc' ||
                     $sortByFirstname === 'desc' ||
                     $sortByDateSubmitted === 'desc') ? 'desc' : 'asc';

        $toggleSortLastname = $this->sortOrder($sortByLastname);
        $toggleSortFirstname = $this->sortOrder($sortByFirstname);
        $sortByDateSubmitted = $this->sortOrder($sortByDateSubmitted);

        $usersQuery = User::where('role_id', 3)
                        ->leftJoin('skillsets', 'users.id', '=', 'skillsets.user_id')
                        ->leftJoin('statuses', 'users.id', '=', 'statuses.user_id')
                        ->leftJoin('applicant_information', 'users.id', '=', 'applicant_information.user_id')
                        ->leftJoin('experiences', 'users.id', '=', 'experiences.user_id')
                        ->select('users.*', 'skillsets.*', 'statuses.*', 'applicant_information.experience', 'experiences.title')
                        ->distinct()
                        ->orderBy($sortByColumn, $sortOrder);

        // Searching
        if ($search = $request->query('search')) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.lastname', 'like', '%' . $search . '%')
                    ->orWhere('skillsets.skill', 'like', '%' . $search . '%')
                    ->orWhere('experiences.title', 'like', '%' . $search . '%');
            });
        }

        // Get the selected tags from the request
        $filters = [
            'websites' => 'skillsets.website',
            'tools' => 'skillsets.tool',
            'skills' => 'skillsets.skill',
            'softskills' => 'skillsets.softskill',
            'experiences' => 'applicant_information.experience',
            'statuses' => 'status',
        ];

        // Apply tag filters
        foreach ($filters as $inputField => $dbField) {
            if ($tags = $request->input($inputField, [])) {
                $usersQuery->where(function ($query) use ($tags, $dbField) {
                    foreach ($tags as $tag) {
                        if (is_numeric($tag)) {
                            $query->orWhere($dbField, '=', $tag);
                        } else if ($dbField=='skillsets.skill') {
                            $query->orWhere($dbField, 'like', '%' . $tag . '%')
                                  ->orWhere('experiences.title', 'like', '%' . $tag . '%');
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
        $skillsets = Skillset::all();

        // Helper function to get unique values from a JSON field
        function getUniqueValues($skillsets, $field) {
            return $skillsets->pluck($field)
                        ->map(function($item) {
                            return json_decode($item, true);
                        })
                        ->flatten()
                        ->unique()
                        ->values()
                        ->all();
        }

        //Array types
        $uniqueWebsites = getUniqueValues($skillsets, 'website');
        $uniqueTools = getUniqueValues($skillsets, 'tool');
        $getUniqueSkills = getUniqueValues($skillsets, 'skill');
        $uniqueSoftskills = getUniqueValues($skillsets, 'softskill');
        //Collection types
        $uniqueStatuses = Status::groupBy('status')->pluck('status');
        $uniqueExperiences = ApplicantInformation::groupBy('experience')->pluck('experience');
        $uniqueTitles = Experience::groupBy('title')->pluck('title');
        //tranform titles to uppercase first letter.
        $getUniqueTitles = array_map('ucfirst', $uniqueTitles->toArray());
        //Combine the collection and array, this is for skills, also display the title.
        $uniqueSkillsFilter = array_merge($getUniqueSkills, $getUniqueTitles);
        //get unique values only in the array.
        $uniqueSkills = array_unique($uniqueSkillsFilter);

        return view('admin-users.index', compact(
            'users',
            'sortByLastname',
            'sortByFirstname',
            'toggleSortLastname',
            'toggleSortFirstname',
            'sortByDateSubmitted',
            'uniqueWebsites',
            'uniqueExperiences',
            'uniqueTools',
            'uniqueSkills',
            'uniqueSoftskills',
            'uniqueStatuses',
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
            'email' => ['required', 'unique:users'],
            'contactnumber' => 'required',
            'age' => 'required|gte:18|lte:60',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'password' => ['required',
            RulesPassword::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'role_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->contactnumber = $request->input('contactnumber');
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->education = $request->input('education');
        $user->address = $request->input('address');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->save();

        $user_id = $user->id;

        $status = new Status();
        $status->status = "New";
        $status->user_id = $user_id;
        $status->save();

        return redirect()->route('admin.users.index')->with('success', 'Applicant has been successfully added!');
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

        $skillset = Skillset::where('user_id', $user->id )
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
        $user->contactnumber = $request->input('contactnumber');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->education = $request->input('education');
        $user->address = $request->input('address');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Applicant\'s information has been successfully edited!');
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
        $user_id = $user->id;
        $userApplicantInformation = ApplicantInformation::where('user_id', $user_id);
        $userSkillset = Skillset::where('user_id', $user_id);
        $userReview = Review::where('user_id', $user_id);
        $userStatus = Status::where('user_id', $user_id);
        $userTier = Tier::where('user_id', $user_id);
        $userExperience = Experience ::where('user_id', $user_id);
        $userCallSample = CallSample::where('user_id', $user_id);

        //check if resume is not null. then proceed with delete.
        if (!isset($user->information->resume)) {
            $user->delete();
            $userApplicantInformation->delete();
            $userSkillset->delete();
            $userReview->delete();
            $userStatus->delete();
            $userTier->delete();
            $userExperience->delete();
            $userCallSample->delete();

        } else {
            $applicantVideo = $user->information->videolink;
            $applicantPortfolio = $user->information->portfolio;
            $applicantResume = $user->information->resume;
            $applicantId = $user->information->photo_id;
            $applicantFormalPhoto = $user->information->photo_formal;
            $applicantDiscResult = $user->information->disc_results;
            $applicantMockCallInbound = $user->mockcalls->inbound_call;
            $applicantMockCallOutbound = $user->mockcalls->outbound_call;

            Storage::delete('public/'.$applicantVideo);
            Storage::delete('public/'.$applicantPortfolio);
            Storage::delete('public/'.$applicantResume);
            Storage::delete('public/'.$applicantId);
            Storage::delete('public/'.$applicantFormalPhoto);
            Storage::delete('public/'.$applicantDiscResult);
            Storage::delete('public/'.$applicantMockCallInbound);
            Storage::delete('public/'.$applicantMockCallOutbound);

            $user->delete();
            $userApplicantInformation->delete();
            $userSkillset->delete();
            $userReview->delete();
            $userStatus->delete();
            $userTier->delete();
            $userExperience->delete();
            $userCallSample->delete();
        }

        return redirect()->route('admin.users.index')->with('success', 'Applicant has been deleted!');

    }

    public function destroySelected(Request $request)
    {
        $selectedUserIds = explode(',', $request->input('selectedUserIds'));

        foreach($selectedUserIds as $userId) {
            $user = User::find($userId);
            $user_id = $user->id;
            $userApplicantInformation = ApplicantInformation::where('user_id', $user_id);
            $userSkillset = Skillset::where('user_id', $user_id);
            $userReview = Review::where('user_id', $user_id);
            $userStatus = Status::where('user_id', $user_id);
            $userTier = Tier::where('user_id', $user_id);
            $userExperience = Experience ::where('user_id', $user_id);
            $userCallSample = CallSample::where('user_id', $user_id);

            if (!isset($user->information->resume))  {
                $user->delete();
                $userApplicantInformation->delete();
                $userSkillset->delete();
                $userReview->delete();
                $userStatus->delete();
                $userTier->delete();
                $userExperience->delete();
                $userCallSample->delete();

            } else {
                $applicantVideo = $user->information->videolink;
                $applicantPortfolio = $user->information->portfolio;
                $applicantResume = $user->information->resume;
                $applicantId = $user->information->photo_id;
                $applicantFormalPhoto = $user->information->photo_formal;
                $applicantDiscResult = $user->information->disc_results;
                $applicantMockCallInbound = $user->mockcalls->inbound_call;
                $applicantMockCallOutbound = $user->mockcalls->outbound_call;

                Storage::delete('public/'.$applicantVideo);
                Storage::delete('public/'.$applicantPortfolio);
                Storage::delete('public/'.$applicantResume);
                Storage::delete('public/'.$applicantId);
                Storage::delete('public/'.$applicantFormalPhoto);
                Storage::delete('public/'.$applicantDiscResult);
                Storage::delete('public/'.$applicantMockCallInbound);
                Storage::delete('public/'.$applicantMockCallOutbound);

                $user->delete();
                $userApplicantInformation->delete();
                $userSkillset->delete();
                $userReview->delete();
                $userStatus->delete();
                $userTier->delete();
                $userExperience->delete();
                $userCallSample->delete();
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Selected applicant(s) has been deleted!');
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

    public function addNotes(Request $request) {

        $this->validate($request, [
            'notes' => 'required',
            'user_id' => 'required',
        ]);

        $attributes = ['user_id' => $request->input('user_id')];

        $review = Review::firstOrNew($attributes);
        $review->notes = $request->input('notes');
        $review->user_id = $request->input('user_id');
        $review->reviewed_by = $request->input('reviewed_by');
        $review->review_status = $request->input('review_status');
        $review->save();

        return back()->with('success', 'Successfully added a note.');
    }

    public function updateStatus(Request $request, $id) {

        $this->validate($request, [
            'status' => 'required',
            'updated_by' => 'required',
        ]);

        $status = Status::where('user_id', $id)->firstOrFail();
        $status->status = $request->input('status');
        $status->lesson = $request->input('lesson');
        $status->updated_by = $request->input('updated_by');
        $status->user_id = $id;
        $status->save();

        $tier = Tier::where('user_id', $id)->firstOrFail();
        $tier->tier = $request->input('tier');
        $tier->user_id = $id;
        $tier->save();

        return back()->with('success', 'Successfully updated applicant\'s status.');
    }
}
