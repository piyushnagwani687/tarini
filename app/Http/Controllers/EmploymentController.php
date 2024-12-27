<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $employments = auth()->user()->employments;
        return view('employment.index', compact('employments', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employer_name' => 'required',
            'position' => 'required',
            'occupation' => 'required',
            'manager_name' => 'required',
            'manager_email' => 'required|email|unique:employments',
        ]);

        Employment::create([
            'user_id' => auth()->user()->id,
            'employer_name' => $request->employer_name,
            'position' => $request->position,
            'occupation' => $request->occupation,
            'manager_name' => $request->manager_name,
            'manager_email' => $request->manager_email
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $employment = Employment::findOrFail($id);
        return view('employment.edit', compact('employment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employment = Employment::findOrFail($id);
        $request->validate([
            'employer_name' => 'required',
            'position' => 'required',
            'occupation' => 'required',
            'manager_name' => 'required',
            'manager_email' => 'required|email|unique:employments,manager_email,'.$id,
        ]);

        $employment->update([
            'employer_name' => $request->employer_name,
            'position' => $request->position,
            'occupation' => $request->occupation,
            'manager_name' => $request->manager_name,
           'manager_email' => $request->manager_email,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employment = Employment::findOrFail($id)->delete();
    }
}
