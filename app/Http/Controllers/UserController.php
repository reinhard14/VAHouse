<?php

namespace App\Http\Controllers;

use App\Models\Skillset;
use App\Models\ApplicantInformation;
use App\Models\CallSample;
use App\Models\Employment;
use App\Models\User;
use App\Models\Experience;
use App\Models\Reference;
use App\Models\UserFormCompletion;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

        return view('user.dashboard', compact('user'));
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
    public function viewProfile($id)
    {
        $user = User::findOrFail($id);

        $ageNow = !empty($user->age) && strtotime($user->age)
                ? Carbon::parse($user->age)
                : null;

        $workList = $user->employment->pluck('job_position')->filter()->implode(', ') ?: 'No job positions available';

        return view('user.view-profile', compact('user', 'ageNow', 'workList'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $user = User::findOrFail($id);

        $skills = [
            // '3D Modelling', 'Accounting', 'Amazon', 'Animation', 'Appointment Scheduling', 'Architecture', 'Article Writing',
            // 'BigCommerce', 'Blogging', 'Bookkeeping',
            // 'Calendar Management' ,'Content Writing', 'Copywriting', 'Creative Writing', 'CRM (Customer Relationship Management)', 'Customer Service',
            // 'Data Entry', 'Dropshipping',
            // 'E-commerce', 'E-commerce SEO', 'Email Marketing', 'Engineering', 'Email Management', 'Executive Assistant',
            // 'Facebook Ads',
            // 'Game Development', 'Google Ads', 'Graphic Design',
            // 'Human Resources', 'HTML & CSS',
            // 'IT Support', 'Illustration', 'Instagram Ads', 'Interior Design',
            // 'Java', 'JavaScript', 'Joomla',
            // 'Lead Generation', 'Legal Services', 'LinkedIn Ads', 'Live Chat Support', 'Local SEO',
            // 'Magento', 'Marketing', 'Music Production',
            // 'On-Page SEO', 'Off-Page SEO',
            // 'Photography', 'Pinterest Ads', 'Podcast Production', 'Print on Demand', 'Professional Email Writing', 'Project Management', 'PHP', 'Python',
            // 'QA Testing', 'Quality Assurance', 'Quality Control',
            // 'Recruitment',
            // 'SEO', 'Sales', 'Shopify', 'Snapchat Ads', 'Social Media Content Creation', 'Social Media Management', 'Social Media Marketing', 'Software Development', 'Sound Design',
            // 'Technical SEO', 'Technical Support', 'Technical Writing', 'TikTok Ads', 'Training', 'Transcription', 'Translation', 'Twitter Ads',
            // 'UI/UX Design',
            // 'Virtual Assistant', 'Videography', 'Video Editing', 'Voice Over',
            // 'Web Design', 'Web Development', 'Website Management',
            // 'WooCommerce',
            // 'YouTube Ads'
        ];

        $softskills = [
            // '1soft', '3D Modelling', 'Accounting', 'Amazon', 'Animation', 'Appointment Scheduling', 'Architecture', 'Article Writing',
            // 'BigCommerce', 'Blogging', 'Bookkeeping',
            // 'Calendar Management' ,'Content Writing', 'Copywriting', 'Creative Writing', 'CRM (Customer Relationship Management)', 'Customer Service',
            // 'Data Entry', 'Dropshipping',
            // 'E-commerce', 'E-commerce SEO', 'Email Marketing', 'Engineering', 'Email Management', 'Executive Assistant',
            // 'Facebook Ads',
            // 'Game Development', 'Google Ads', 'Graphic Design',
            // 'Human Resources', 'HTML & CSS',
            // 'IT Support', 'Illustration', 'Instagram Ads', 'Interior Design',
            // 'Java', 'JavaScript', 'Joomla',
            // 'Lead Generation', 'Legal Services', 'LinkedIn Ads', 'Live Chat Support', 'Local SEO',
            // 'Magento', 'Marketing', 'Music Production',
            // 'On-Page SEO', 'Off-Page SEO',
            // 'Photography', 'Pinterest Ads', 'Podcast Production', 'Print on Demand', 'Professional Email Writing', 'Project Management', 'PHP', 'Python',
            // 'QA Testing', 'Quality Assurance', 'Quality Control',
            // 'Recruitment',
            // 'SEO', 'Sales', 'Shopify', 'Snapchat Ads', 'Social Media Content Creation', 'Social Media Management', 'Social Media Marketing', 'Software Development', 'Sound Design',
            // 'Technical SEO', 'Technical Support', 'Technical Writing', 'TikTok Ads', 'Training', 'Transcription', 'Translation', 'Twitter Ads',
            // 'UI/UX Design',
            // 'Virtual Assistant', 'Videography', 'Video Editing', 'Voice Over',
            // 'Web Design', 'Web Development', 'Website Management',
            // 'WooCommerce',
            // 'YouTube Ads'
        ];

        $tools = [
            // '1tool', '3D Modelling', 'Accounting', 'Amazon', 'Animation', 'Appointment Scheduling', 'Architecture', 'Article Writing',
            // 'BigCommerce', 'Blogging', 'Bookkeeping',
            // 'Calendar Management' ,'Content Writing', 'Copywriting', 'Creative Writing', 'CRM (Customer Relationship Management)', 'Customer Service',
            // 'Data Entry', 'Dropshipping',
            // 'E-commerce', 'E-commerce SEO', 'Email Marketing', 'Engineering', 'Email Management', 'Executive Assistant',
            // 'Facebook Ads',
            // 'Game Development', 'Google Ads', 'Graphic Design',
            // 'Human Resources', 'HTML & CSS',
            // 'IT Support', 'Illustration', 'Instagram Ads', 'Interior Design',
            // 'Java', 'JavaScript', 'Joomla',
            // 'Lead Generation', 'Legal Services', 'LinkedIn Ads', 'Live Chat Support', 'Local SEO',
            // 'Magento', 'Marketing', 'Music Production',
            // 'On-Page SEO', 'Off-Page SEO',
            // 'Photography', 'Pinterest Ads', 'Podcast Production', 'Print on Demand', 'Professional Email Writing', 'Project Management', 'PHP', 'Python',
            // 'QA Testing', 'Quality Assurance', 'Quality Control',
            // 'Recruitment',
            // 'SEO', 'Sales', 'Shopify', 'Snapchat Ads', 'Social Media Content Creation', 'Social Media Management', 'Social Media Marketing', 'Software Development', 'Sound Design',
            // 'Technical SEO', 'Technical Support', 'Technical Writing', 'TikTok Ads', 'Training', 'Transcription', 'Translation', 'Twitter Ads',
            // 'UI/UX Design',
            // 'Virtual Assistant', 'Videography', 'Video Editing', 'Voice Over',
            // 'Web Design', 'Web Development', 'Website Management',
            // 'WooCommerce',
            // 'YouTube Ads'
        ];

        $days = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
        ];

        //LOAD JOB INFORMATION
        //! Eager load User Information, and Skillset relationships
        $userInformation = User::with('information', 'skillsets', 'references')->find($id);

        // Decode JSON data
        function decodeJsonArray($data) {
            return isset($data) && !is_null($data) ? json_decode($data, true) : [];
        }
        // $decodeSkillset = function ($data) {
        //     return isset($data) && !is_null($data) ? json_decode($data, true) : [];
        // };

        // Extract positions
        $positionsItemize = decodeJsonArray($user->information->positions ?? null);
        $daysItemize = decodeJsonArray($user->information->days_available ?? null);

        // Extract references
        $workstatusItemize = decodeJsonArray($user->references->work_status ?? null);
        $preferredShift = decodeJsonArray($user->references->preferred_shift ?? null);

        //skillsets extraction
        $applicantSkills = decodeJsonArray($user->skillsets->skill ?? null);
        $applicantSoftSkills = decodeJsonArray($user->skillsets->softskill ?? null);
        $applicantTools = decodeJsonArray($user->skillsets->tool ?? null);

        $availableSkills = array_diff($skills, $applicantSkills);
        $availableSoftSkills = array_diff($softskills, $applicantSoftSkills);
        $availableTools = array_diff($tools, $applicantTools);
        $availableDays = array_diff($days, $daysItemize);

        return view('user.edit-profile', compact('user', 'skills', 'softskills', 'tools', 'positionsItemize', 'workstatusItemize', 'preferredShift',
                    'applicantSkills', 'applicantSoftSkills', 'applicantTools', 'availableSkills', 'availableSoftSkills', 'availableTools',
                    'availableDays', 'daysItemize', 'days'));
    }

    public function updatePersonalDetails(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            // 'suffix' => 'required',
            'gender' => 'required',
            'contactnumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'birthdate' => 'required',
            'nationality' => 'required',
            'civil_status' => 'required',
            'education' => 'required',
            'degree' => 'required',
            'skype' => 'required',
            'ub_account' => 'required',
            'ub_number' => 'required',
            'emergency_person' => 'required',
            'emergency_number' => 'required',
            'emergency_relationship' => 'required',
            //files
            'photo_formal' => 'required|max:64000',
        ],  [
            'photo_formal.required' => 'Formal Photo file is missing.',
            'photo_formal.mimes' => 'Formal Photo must be an image file.',
            'photo_formal.max' => 'Formal photo file size exceed the 64 MB limit!',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo_formal')) {
            $formalPath = $request->file('photo_formal')->store('formals', 'public');
        } else {
            return back()->with('error', 'Please upload a file.');
        }

        // $user->information->photo_id = $request->input('photo_id');

        $user->name = $request->input('name');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->suffix = $request->input('suffix');
        $user->gender = $request->input('gender');
        $user->contactnumber = $request->input('contactnumber');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        //BIRTHDATE WILL BE USED IN AGE NOW.
        $user->age = $request->input('birthdate');
        //update:newly migrated table updated.
        $user->nationality = $request->input('nationality');
        $user->civil_status = $request->input('civil_status');
        $user->education = $request->input('education');
        $user->degree = $request->input('degree');

        //update/create existing information.
        $information = ApplicantInformation::updateOrCreate(
            ['user_id' => $id],
            [
                'user_id' => $id,
                'skype' => $request->input('skype'),
                'ub_account' => $request->input('ub_account'),
                'ub_number' => $request->input('ub_number'),
                'photo_formal' => $formalPath,
            ]
        );
        // dd($formalPath);

        //Emergency Contact Information
        //update existing references.
        $references = Reference::updateOrCreate(
            ['user_id' => $id],
            [
                'user_id' => $id,
                'emergency_person' => $request->input('emergency_person'),
                'emergency_number' => $request->input('emergency_number'),
                'emergency_relationship' => $request->input('emergency_relationship')
            ]
        );

        //Save to users table.
        $user->save();

        return redirect()->route('user.edit', $user->id)->with('success', 'Personal details successfully updated!')
                                                        ->with('tab', '#job-information');
    }

    public function updateJobInformation(Request $request, $id)
    {

        $this->validate($request, [
            'positions' => 'required|array|min:1',
            'positions.*' => 'string',
            'work_status' => 'required',
            // // 'days_available' => 'required',
            'preferred_start' => 'required',
            'preferred_end' => 'required',
            // 'preferred_shift' => 'required',
            // //user information
            'rate' => 'required',
            'specify' => [
                'required_if:positions,Others',
                'string'
            ],
            'days_available' => 'required',
            // 'negotiable' => 'sometimes',
            //use services_offered col for job description field.
            'services_offered' => 'required',
            // // 'salary_negotiable' => 'required',
            // // Job Profile
            'skills' => 'required|array',
            'skills.*' => 'string',
            // 'softskills' => 'array',
            // 'softskills.*' => 'string',
            // 'tools' => 'required|array',
            // 'tools.*' => 'string',
        ], [
            'preferred_start.required' => 'Please select start time for working hour shift.',
            'preferred_end.required' => 'Please select end time for work shift.',
            'services_offered' => 'Please enter job description.',
            'specify.required_if' => 'Please specify the position.',
            'specify.string' => 'Please specify the position for "Others" before proceeding.',

        ]);

        $user = User::findOrFail($id);

        //update/create existing information.
        $information = ApplicantInformation::updateOrCreate(
            ['user_id' => $id],
            [
                'user_id' => $id,
                'positions' => json_encode($request->input('positions')),
                'rate' => $request->input('rate'),
                'specify' => $request->input('specify'),
                'days_available' => json_encode($request->input('days_available')),
                'negotiable' => $request->input('negotiable'),
            ]
        );

        //update existing references.
        $references = Reference::updateOrCreate(
            ['user_id' => $id],
            [
                'user_id' => $id,
                'work_status' => $request->input('work_status'),
                'preferred_shift' => json_encode([
                    'start' => $request->input('preferred_start','preferred_start'),
                    'end' => $request->input('preferred_start','preferred_end'),
                ]),
                'services_offered' => $request->input('services_offered'),
            ]
        );

        //update existing skillset.
        $skillsets = Skillset::updateOrCreate(
            ['user_id' => $id],
            [
                'user_id' => $id,
                'skill' => json_encode($request->input('skills')),
                'softskill' => json_encode($request->input('softskills')),
                'tool' => json_encode($request->input('tools')),

            ]
        );


        return redirect()->route('user.edit', $user->id)->with('success', 'Job Information successfully updated!')
                                                        ->with('tab', '#file-uploads');
    }

    public function uploadValidId(Request $request) {

        $this->validate($request, [
            'photo_id' => 'required|mimes:jpeg,png,jpg|max:64000',
        ], [
            'photo_id.required' => 'ID photo file is missing.',
            'photo_id.mimes' => 'ID photo must be an image file.',
            'photo_id.max' => 'ID photo file size exceed the 64 MB limit!',
        ]);

        if (!$request->hasFile('photo_id')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validIdPath = $request->file('photo_id')->store('IDs', 'public');

        $user_id = Auth::id();

        $validId = ApplicantInformation::updateOrCreate(
            ['user_id' => $user_id],
            ['photo_id' => $validIdPath]
        );

        return response()->json([
            'success' => true,
            'message' => 'Valid ID has been uploaded!',
            'validId' => $validId,
        ]);

    }

    public function uploadResume(Request $request) {

        $this->validate($request, [
            'resume' => 'required|mimes:pdf|max:32000',
        ], [
            'resume.required' => 'Resume file is missing.',
            'resume.max' => 'Resume file size exceed the 32 MB limit!',
        ]);

        if (!$request->hasFile('resume')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validResumePath = $request->file('resume')->store('pdfs', 'public');

        $user_id = Auth::id();

        $validResume = ApplicantInformation::updateOrCreate(
            ['user_id' => $user_id],
            ['resume' => $validResumePath]
        );

        return response()->json([
            'success' => true,
            'message' => 'Valid resume/CV has been uploaded!',
            'validResume' => $validResume,
        ]);

    }

    public function uploadPortfolio(Request $request) {

        $this->validate($request, [
            'portfolio' => 'required|mimes:pdf|max:32000',
        ], [
            'portfolio.required' => 'Resume file is missing.',
            'portfolio.max' => 'Resume file size exceed the 32 MB limit!',
        ]);

        if (!$request->hasFile('portfolio')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validPortfolioPath = $request->file('portfolio')->store('portfolios', 'public');

        $user_id = Auth::id();

        $validPortfolio = ApplicantInformation::updateOrCreate(
            ['user_id' => $user_id],
            ['portfolio' => $validPortfolioPath]
        );

        return response()->json([
            'success' => true,
            'message' => 'Valid portfolio has been uploaded!',
            'validPortfolio' => $validPortfolio,
        ]);

    }

    public function uploadDisc(Request $request) {

        $this->validate($request, [
            'disc_results' => 'required|mimes:pdf|max:32000',
        ], [
            'disc_results.required' => 'Disc result file is required.',
            'disc_results.max' => 'Disc result file size exceed the 32 MB limit!',
        ]);

        if (!$request->hasFile('disc_results')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validDiscPath = $request->file('disc_results')->store('DISC_Results', 'public');

        $user_id = Auth::id();

        $validDisc = ApplicantInformation::updateOrCreate(
            ['user_id' => $user_id],
            ['disc_results' => $validDiscPath]
        );

        return response()->json([
            'success' => true,
            'message' => 'Disc results has been uploaded!',
            'validDisc' => $validDisc,
        ]);

    }

    public function uploadVideo(Request $request) {

        $this->validate($request, [
            'videolink' => 'required|mimes:mp4,avi,wmv|max:128000',
        ], [
            'videolink.required' => 'Video file is missing.',
            'videolink.mimes' => 'Video Introduction file type must be MP4.',
            'videolink.max' => 'Video file size exceed the 128000 MB limit!',
        ]);

        if (!$request->hasFile('videolink')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validVideoPath = $request->file('videolink')->store('intro_videos', 'public');

        $user_id = Auth::id();

        $validVideo = ApplicantInformation::updateOrCreate(
            ['user_id' => $user_id],
            ['videolink' => $validVideoPath]
        );

        return response()->json([
            'success' => true,
            'message' => 'Video has been uploaded!',
            'validId' => $validVideo,
        ]);

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
            'employment_type' => 'required',
            'date_started' => 'required',
            'date_ended' => 'required',
            'job_position' => 'required',
            'company_details' => 'required',
            'job_details' => 'required',
            'user_id' => 'required',
        ], [
            'employment_type.required' => 'Employment type is a required.',
            'date_started.required' => 'Start date type is required.',
            'date_ended.required' => 'End date is required.',
            'job_position.required' => 'Job position is required.',
            'company_details.required' => 'Company name and address is required.',
            'job_details.required' => 'Job details is required.',
        ]);
        // dd($request->all()); // This will output the request data and stop execution
        // \Log::info($request->all());

        //ajax showing

        $employment = new Employment();
        $employment->employment_type = $request->input('employment_type');
        $employment->date_started = $request->input('date_started');
        $employment->date_ended = $request->input('date_ended');
        $employment->job_position = $request->input('job_position');
        $employment->company_details = $request->input('company_details');
        $employment->job_details = $request->input('job_details');
        $employment->user_id = $request->input('user_id');
        $employment->save();

        return response()->json([
            'success' => true,
            'message' => 'Employment details has been saved successfully!',
            'employment' => $employment,
        ]);
    }

    public function uploadInboundCall(Request $request) {

        $this->validate($request, [
            'inbound_call' => 'required|mimes:mp4,avi,wmv,mp3,wav,aac,flac,ogg,wma|max:32000',
        ], [
            'inbound_call.required' => 'Inbound call file is missing.',
            'inbound_call.mimes' => 'Inbound call file type is incorrect.',
            'inbound_call.max' => 'Inbound call file size exceed the 32000 MB limit!',
        ]);

        if (!$request->hasFile('inbound_call')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validInboundPath = $request->file('inbound_call')->store('mockcalls/inbounds', 'public');

        $user_id = Auth::id();

        $validInboundCall = CallSample::updateOrCreate(
            ['user_id' => $user_id],
            ['inbound_call' => $validInboundPath],
        );

        return response()->json([
            'success' => true,
            'message' => 'Inbound call has been saved!',
            'inbound' => $validInboundCall,

        ]);
    }

    public function uploadOutboundCall(Request $request) {

        $this->validate($request, [
            'outbound_call' => 'required|mimes:mp4,avi,wmv,mp3,wav,aac,flac,ogg,wma|max:32000',
        ], [
            'outbound_call.required' => 'Inbound call file is missing.',
            'outbound_call.mimes' => 'Inbound call file type is incorrect.',
            'outbound_call.max' => 'Inbound call file size exceed the 32000 MB limit!',
        ]);

        if (!$request->hasFile('outbound_call')) {
            return back()->with('error', 'Please upload a file.');
        }

        $validOutboundPath = $request->file('outbound_call')->store('mockcalls/outbounds', 'public');

        $user_id = Auth::id();

        $validOutboundCall = CallSample::updateOrCreate(
            ['user_id' => $user_id],
            ['outbound_call' => $validOutboundPath],
        );

        return response()->json([
            'success' => true,
            'message' => 'Outbound call has been saved!',
            'outbound' => $validOutboundCall,
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

    public function viewFile($filename)
    {
        // Check if the file exists
        if (!Storage::disk('public')->exists($filename)) {
            abort(404);
        }

        // Get the file's content
        $fileContent = Storage::disk('public')->get($filename);

        // Return the file's content as a response
        return response($fileContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

}
