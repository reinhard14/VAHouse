<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInformation;
use App\Models\CallSample;
use App\Models\Experience;
use App\Models\Reference;
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
        $displayIncompleteApplicants = $request->query('display');

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

        $applicant = 3;

        //!disable for now
        // //default, display is null -> show with skills only
        // if(is_null($displayIncompleteApplicants)) {
        //     $usersQuery = User::where('role_id', $applicant)
        //                         ->whereHas('skillsets', function($query) {
        //                             $query->whereNotNull('skill');
        //                         })
        //                         ->with(['skillsets', 'status', 'information', 'experiences'])
        //                         ->orderBy($sortByColumn, $sortOrder);
        // } else {
        //     $usersQuery = User::where('role_id', $applicant)
        //                         ->with(['skillsets', 'status', 'information', 'experiences'])
        //                         ->orderBy($sortByColumn, $sortOrder);
        //     }

        // // Searching
        // if ($search = $request->query('search')) {
        //     $usersQuery->where(function($query) use ($search) {
        //         $query->where('name', 'LIKE', '%' . $search . '%')
        //             ->orWhere('lastname', 'LIKE', '%' . $search . '%')
        //             ->orWhereHas('skillsets', function($query) use ($search) {
        //                 $query->where('skill', 'LIKE', '%' . $search . '%');
        //             })
        //             ->orWhereHas('experiences', function($query) use ($search) {
        //                 $query->where('title', 'LIKE', '%' . $search . '%');
        //             });
        //     });
        // }

        // if ($skills = $request->query('skills')) {
        //     $skillsArray = explode(',', $skills);

        //     $usersQuery->whereHas('skillsets', function($query) use ($skillsArray) {
        //         if (is_array($skillsArray)) {
        //             $query->whereIn('skill', $skills);
        //         }
        //     });
        // }
        //! end
        $applicant = 3;
        if(is_null($displayIncompleteApplicants)) {
            $usersQuery = User::where('role_id', $applicant)
                            ->whereNotNull('skillsets.id')
                            ->leftJoin('skillsets', 'users.id', '=', 'skillsets.user_id')
                            ->leftJoin('statuses', 'users.id', '=', 'statuses.user_id')
                            ->leftJoin('applicant_information', 'users.id', '=', 'applicant_information.user_id')
                            ->leftJoin('experiences', 'users.id', '=', 'experiences.user_id')
                            ->leftJoin('tiers', 'users.id', '=', 'tiers.user_id')
                            ->select('users.*', 'skillsets.*', 'statuses.*', 'applicant_information.experience', 'experiences.title', 'tiers.*')
                            //distinct causes pagination error. find another way, try use groupby.
                            ->distinct()
                            ->orderBy($sortByColumn, $sortOrder);
        } else {
            $usersQuery = User::where('role_id', $applicant)
                            ->leftJoin('skillsets', 'users.id', '=', 'skillsets.user_id')
                            ->leftJoin('statuses', 'users.id', '=', 'statuses.user_id')
                            ->leftJoin('applicant_information', 'users.id', '=', 'applicant_information.user_id')
                            ->leftJoin('experiences', 'users.id', '=', 'experiences.user_id')
                            ->leftJoin('tiers', 'users.id', '=', 'tiers.user_id')
                            ->select('users.*', 'skillsets.*', 'statuses.*', 'applicant_information.experience', 'experiences.title', 'tiers.*')
                            //distinct causes pagination error. find another way, try use groupby.
                            ->distinct()
                            ->orderBy($sortByColumn, $sortOrder);
        }

        // Searching
        if ($search = $request->query('search')) {
            $usersQuery->where(function ($query) use ($search) {
                        $query->where('users.name', 'like', '%' . $search . '%')
                            ->orWhere('users.lastname', 'like', '%' . $search . '%')
                            ->orWhere('skillsets.skill', 'like', '%' . $search . '%')
                            ->orWhere('experiences.title', 'like', '%' . $search . '%');
            });
            // $sortByLastname = $request->query('sortByLastname');
            // $sortByFirstname = $request->query('sortByFirstname');
            // $sortByDateSubmitted = $request->query('sortByDateSubmitted');
            $displayIncompleteApplicants = $request->query('display');

        }

        // Get the selected tags from the request
        $filters = [
            'websites' => 'skillsets.website',
            'tools' => 'skillsets.tool',
            'skills' => 'skillsets.skill',
            'softskills' => 'skillsets.softskill',
            'experiences' => 'applicant_information.experience',
            'statuses' => 'status',
            'tiers' => 'tier',
            'LMS' => 'lesson',
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

        // Get the results with pagination.
        $users = $usersQuery->select('users.*')->paginate(12);

        // Append parameters to pagination links.
        $users->appends(['sortByLastname' => $sortByLastname, 'sortByFirstname' => $sortByFirstname,
                         'sortByDateSubmitted' => $sortByDateSubmitted,'display' => $displayIncompleteApplicants,
                         'searchResult' => $search]);

        // get data of skillset to display on select filters.
        $skillsets = Skillset::all();

        //Array types
        $uniqueWebsites = $this->getUniqueValues($skillsets, 'website');
        $uniqueTools = $this->getUniqueValues($skillsets, 'tool');
        $getUniqueSkills = $this->getUniqueValues($skillsets, 'skill');
        $uniqueSoftskills = $this->getUniqueValues($skillsets, 'softskill');
        //Collection types
        $uniqueStatuses = Status::groupBy('status')->pluck('status');
        $uniqueExperiences = ApplicantInformation::groupBy('experience')->pluck('experience');
        $uniqueTitles = Experience::groupBy('title')->pluck('title');
        $uniqueTiers = Tier::groupBy('tier')->pluck('tier');
        $uniqueLMS = Status::groupBy('lesson')->pluck('lesson');

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
            'uniqueTiers',
            'uniqueLMS',
            'displayIncompleteApplicants',
        ));

    }
    // Helper function to get unique values from a JSON field
    private function getUniqueValues($skillsets, $field) {
        return $skillsets->pluck($field)
                    ->map(function($item) {
                        return json_decode($item, true);
                    })
                    ->flatten()
                    ->unique()
                    ->values()
                    ->all();
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
        $displayIncompleteUsers = $request->input('display');
        $sortByFirstname = $request->input('sortByFirstname');
        $sortByLastname = $request->input('sortByLastname');
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $page = $request->input('page');
        $search = $request->input('search');

        $this->validate($request, [
            'age' => 'required|gte:18|lte:60',
            'email' => 'required|unique:users',
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
        // $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('admin.users.index', [
                            'display' => $displayIncompleteUsers,
                            'sortByFirstname' => $sortByFirstname,
                            'sortByLastname' => $sortByLastname,
                            'sortByDateSubmitted' => $sortByDateSubmitted,
                            'page' => $page,
                            'search' => $search,
                        ])->with('success', "{$user->name} {$user->lastname}'s information has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $sortByLastname = $request->input('sortByLastname');
        $sortByFirstname = $request->input('sortByFirstname');
        $displayIncompleteUsers = $request->input('display');
        $page = $request->input('page');
        $search = $request->input('search');

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
            $userStatus->delete();
            $userTier->delete();

        } else {
            $applicantVideo = $user->information->videolink;
            $applicantPortfolio = $user->information->portfolio;
            $applicantResume = $user->information->resume;
            $applicantId = $user->information->photo_id;
            $applicantFormalPhoto = $user->information->photo_formal;
            $applicantDiscResult = $user->information->disc_results;
            $applicantMockCallInbound = $user->mockcalls->inbound_call ?? null;
            $applicantMockCallOutbound = $user->mockcalls->outbound_call ?? null;

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

        return redirect()->route('admin.users.index', [
                                'display' => $displayIncompleteUsers,
                                'sortByFirstname' => $sortByFirstname,
                                'sortByLastname' => $sortByLastname,
                                'sortByDateSubmitted' => $sortByDateSubmitted,
                                'page' => $page,
                                'search' => $search,
                        ])->with('success', "{$user->name} {$user->lastname}'s record has been deleted!");

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
                $userStatus->delete();
                $userTier->delete();

            } else {
                $applicantVideo = $user->information->videolink;
                $applicantPortfolio = $user->information->portfolio;
                $applicantResume = $user->information->resume;
                $applicantId = $user->information->photo_id;
                $applicantFormalPhoto = $user->information->photo_formal;
                $applicantDiscResult = $user->information->disc_results;
                $applicantMockCallInbound = $user->mockcalls->inbound_call ?? null;
                $applicantMockCallOutbound = $user->mockcalls->outbound_call ?? null;

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

        $displayIncompleteUsers = $request->input('display');
        $sortByFirstname = $request->input('sortByFirstname');
        $sortByLastname = $request->input('sortByLastname');
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $page = $request->input('page');
        $search = $request->input('search');

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

        return response()->json([
            'success' => true,
            'review'=> $review,
            'data' => [
                'displayIncompleteUsers' => $displayIncompleteUsers,
                'sortByFirstname' => $sortByFirstname,
                'sortByLastname' => $sortByLastname,
                'sortByDateSubmitted' => $sortByDateSubmitted,
                'page' => $page,
                'search' => $search,
            ]
        ]);
    }

    public function updateStatus(Request $request, $id) {

        $this->validate($request, [
            'status' => 'required',
            'tier' => 'required',
            'updated_by' => 'required',
        ]);

        $attributes = ['user_id' => $id];

        $status = Status::firstOrNew($attributes);
        $status->status = $request->input('status');
        $status->lesson = $request->input('lesson');
        $status->updated_by = $request->input('updated_by');
        $status->user_id = $id;
        $status->save();

        $tier = Tier::firstOrNew($attributes);
        $tier->tier = $request->input('tier');
        $tier->user_id = $id;
        $tier->save();

        return response()->json([
            'success' => true,
            'status'=> $status,
            'tier'=> $tier,
        ]);
    }

    public function updatePassword(Request $request, $id)
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
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "{$user->name} {$user->lastname}'s password has been updated!");
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'rate' => 'required',
            'experience' => 'required|gte:0',
            'skype' => 'required',
            'niche' => 'required',
            'ub_account' => 'required',
            'ub_number' => 'required',
            'positions' => 'sometimes|array|min:1',
            'positions.*' => 'string',
        ]);

        $attributes = ['user_id' => $id];

        $information = ApplicantInformation::firstOrNew($attributes);
        $information->rate = $request->input('rate');
        $information->experience = $request->input('experience');
        $information->skype = $request->input('skype');
        $information->niche = $request->input('niche');
        $information->ub_account = $request->input('ub_account');
        $information->ub_number = $request->input('ub_number');
        $information->user_id = $id;
        $information->positions = json_encode($request->input('positions'));
        $information->save();

        return redirect()->route('admin.users.index')->with('success', "{$information->user->name} {$information->user->lastname}'s VA profile has been updated!");
    }

    public function updateSkillsets(Request $request, $id)
    {
        $this->validate($request, [
            'skills' => 'sometimes|array|min:1',
            'skills.*' => 'string',
            'tools' => 'sometimes|array|min:1',
            'tools.*' => 'string',
            'websites' => 'sometimes|array|min:1',
            'websites.*' => 'string',
            'softskills' => 'sometimes|array|min:1',
            'softskills.*' => 'string',
        ]);

        $attributes = ['user_id' => $id];

        $skillset = Skillset::firstOrNew($attributes);
        $skillset->skill = json_encode($request->input('skills'));
        $skillset->tool = json_encode($request->input('tools'));
        $skillset->website = json_encode($request->input('websites'));
        $skillset->softskill = json_encode($request->input('softskills'));
        $skillset->user_id = $id;
        $skillset->save();

        return redirect()->route('admin.users.index')->with('success', "{$skillset->user->name} {$skillset->user->lastname}'s skillset has been updated!");
    }

    public function updateReferences(Request $request, $id)
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

        $userId = $id;
        $user_id = ['user_id' => $userId];
        $reference = Reference::firstOrNew($user_id);
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

        return redirect()->route('admin.users.index')->with('success', "{$reference->user->name} {$reference->user->lastname}'s VA references has been updated!");
    }

    public function deleteFile(Request $request, $id, $field)
    {
        $displayIncompleteUsers = $request->input('display');
        $sortByFirstname = $request->input('sortByFirstname');
        $sortByLastname = $request->input('sortByLastname');
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $page = $request->input('page');
        $search = $request->input('search');

        $validFields = ['videolink', 'resume', 'portfolio', 'photo_id',
                        'photo_formal', 'disc_results'];

        $mockValidFields = ['inbound_call', 'outbound_call'];

        if (!in_array($field, array_merge($validFields, $mockValidFields))) {
            return redirect()->back()->with('error', 'Invalid field specified.');
        }

        if (in_array($field, $validFields)){
            $record = ApplicantInformation::firstOrNew(['id' => $id]);
        } else {
            $record = CallSample::firstOrNew(['id' => $id]);
        }

        $filePath = $record->$field;

        if ($filePath && Storage::exists('public/' . $filePath)) {
            Storage::delete('public/' . $filePath);
        }

        $record->$field = null;
        $record->save();

        //find out why field of mockcall not properly read. THIS HAS BUG on returning ->with if users is set to $record->user->name.
        if (in_array($field, $mockValidFields)) {
            $user = 'It';
        } else {
            $user = $record->user->name;
        }

        return redirect()->route('admin.users.index', [
                            'display' => $displayIncompleteUsers,
                            'sortByFirstname' => $sortByFirstname,
                            'sortByLastname' => $sortByLastname,
                            'sortByDateSubmitted' => $sortByDateSubmitted,
                            'page' => $page,
                            'search' => $search,
                        ])->with('success', "{$user}'s {$field} file has been deleted successfully.");
    }

    public function storeFile(Request $request, $field)
    {
        $user_id = $request->input('user_id');
        $displayIncompleteUsers = $request->input('display');
        $sortByFirstname = $request->input('sortByFirstname');
        $sortByLastname = $request->input('sortByLastname');
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $page = $request->input('page');
        $search = $request->input('search');

        $mockValidFields = ['inbound_call', 'outbound_call'];

        $fieldsStorage = [
            'inbound_call' => 'mockcalls/inbounds',
            'outbound_call' => 'mockcalls/outbounds',
        ];

        if (!in_array($field, $mockValidFields)) {
            return redirect()->back()->with('error', 'Invalid field specified.');
        }

        $record = new CallSample;

        if ($request->hasFile($field)) {
            $filePath = $request->file($field)->store($fieldsStorage[$field], 'public');
            $record->$field = $filePath;
            $record->user_id = $user_id;
            $record->save();
        } else {
            return redirect()->back()->with('error', 'No file provided.');
        }

        $user = 'It';

        return redirect()->route('admin.users.index', [
                            'display' => $displayIncompleteUsers,
                            'sortByFirstname' => $sortByFirstname,
                            'sortByLastname' => $sortByLastname,
                            'sortByDateSubmitted' => $sortByDateSubmitted,
                            'page' => $page,
                            'search' => $search,
                        ])->with('success', "{$user}'s {$field} file has been updated successfully.");
    }

    public function updateFile(Request $request, $id, $field)
    {
        $this->validate($request, [
            'inbound_call' => 'mimes:mp4,avi,wmv,mp3,wav,aac,flac,ogg,wma|max:32000',
            'outbound_call' => 'mimes:mp4,avi,wmv,mp3,wav,aac,flac,ogg,wma|max:32000',
        ], [
            'inbound_call.mimes' => 'Inbound call file type is incorrect.',
            'inbound_call.max' => 'Inbound call file size exceed the 32000 MB limit!',

            'outbound_call.mimes' => 'Outbound call file type is incorrect.',
            'outbound_call.max' => 'Outbound call file size exceed the 32000 MB limit!',
        ]);

        $displayIncompleteUsers = $request->input('display');
        $sortByFirstname = $request->input('sortByFirstname');
        $sortByLastname = $request->input('sortByLastname');
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $page = $request->input('page');
        $search = $request->input('search');
        // \Log::info('Request data: ', $request->all());
        // dd($request->input('display'));
        $validFields = ['videolink', 'resume', 'portfolio', 'photo_id',
                        'photo_formal', 'disc_results'];
        $mockValidFields = ['inbound_call', 'outbound_call'];

        $fieldsStorage = [
            'videolink' => 'intro_videos',
            'resume' => 'pdfs',
            'portfolio' => 'portfolios',
            'photo_id' => 'IDs',
            'photo_formal' => 'formals',
            'disc_results' => 'DISC_Results',
            'inbound_call' => 'mockcalls/inbounds',
            'outbound_call' => 'mockcalls/outbounds',
        ];

        if (!in_array($field, array_merge($validFields, $mockValidFields))) {
            return redirect()->back()->with('error', 'Invalid field specified.');
        }

        if (in_array($field, $validFields)){
            $record = ApplicantInformation::firstOrNew(['id' => $id]);
        } else {
            $record = CallSample::firstOrNew(['id' => $id]);
        }

        if ($request->hasFile($field)) {
            $filePath = $request->file($field)->store($fieldsStorage[$field], 'public');
            $record->$field = $filePath;
            $record->save();
        } else {
            return redirect()->back()->with('error', 'No file provided.');
        }
        //find out why field of mockcall not properly read. THIS HAS BUG on returning ->with if users is set to $record->user->name.
        if (in_array($field, $mockValidFields)) {
            $user = 'It';
        } else {
            $user = $record->user->name;
        }
        return redirect()->route('admin.users.index', [
                            'display' => $displayIncompleteUsers,
                            'sortByFirstname' => $sortByFirstname,
                            'sortByLastname' => $sortByLastname,
                            'sortByDateSubmitted' => $sortByDateSubmitted,
                            'page' => $page,
                            'search' => $search,
                        ])->with('success', "{$user}'s {$field} file has been updated successfully.");
    }

    public function deleteExperience(Request $request, $id)
    {
        $displayIncompleteUsers = $request->input('display');
        $sortByFirstname = $request->input('sortByFirstname');
        $sortByLastname = $request->input('sortByLastname');
        $sortByDateSubmitted = $request->input('sortByDateSubmitted');
        $page = $request->input('page');
        $search = $request->input('search');

        $experience = Experience::findOrFail($id);
        $experience->delete();

        $user = $experience->user->name;

        return redirect()->route('admin.users.index', [
            'display' => $displayIncompleteUsers,
            'sortByFirstname' => $sortByFirstname,
            'sortByLastname' => $sortByLastname,
            'sortByDateSubmitted' => $sortByDateSubmitted,
            'page' => $page,
            'search' => $search,
        ])->with('success', "{$user}'s experience data has been deleted successfully.");
    }

}
