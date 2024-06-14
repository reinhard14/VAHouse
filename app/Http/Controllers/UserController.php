<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use App\Models\PDF;
use Illuminate\Support\Facades\Storage;
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
        ]);

        // Handle PDF file upload
        if ($request->hasFile('resume')) {
            $pdfPath = $request->file('resume')->store('pdfs', 'public');
        } else {
            // Handle the case when no PDF file is uploaded
            return back()->with('error', 'Please upload a PDF file.');
        }

        // Create a new Score instance
        $score = new Score();
        $score->website = json_encode($request->input('websites'));
        $score->tool = json_encode($request->input('tools'));
        $score->skill = json_encode($request->input('skills'));
        $score->softskill = json_encode($request->input('softskills'));
        $score->rate = $request->input('rate');
        $score->videolink = $request->input('videolink');
        $score->portfolio = $request->input('portfolio');
        $score->experience = $request->input('experience');
        $score->resume = $pdfPath; // Save the path to the PDF file
        $score->user_id = Auth::id();
        $score->save();

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

            // $applications = Score::where('user_id', $user->id)
            //                 ->latest('created_at')
            //                 ->value('application');

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
            // $aApplications = json_decode($applications);
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
        //test
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
