<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;


class DepartmentController extends Controller
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
        $departments = Department::paginate(10);

        return view('department.index', compact('departments'));
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
            'code' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $department = new Department();
        $department->code = $request->input('code');
        $department->name = $request->input('name');
        $department->description = $request->input('description');

        $department->save();

        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

    public function show(Department $department)
    {
        $department = Department::find($department->id);
        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

    public function edit(Department $department)
    {
        $department = Department::findOrFail($department->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Department $department)
    {

        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $department = Department::findOrFail($department->id);

        $department->code = $request->input('code');
        $department->name = $request->input('name');
        $department->description = $request->input('description');
        $department->save();

        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department = Department::find($department->id);
        $department->delete();

        return redirect()->route('department.index');
    }

    public function destroySelected(Request $request)
    {
        $selectedDepartmentIds = explode(',', $request->input('selectedDepartmentIds'));

        foreach($selectedDepartmentIds as $departmentId) {
            $department = Department::find($departmentId);
            $department->delete();
        }

        return redirect()->route('department.index');
    }
}
