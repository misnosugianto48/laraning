<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assign = Assignment::with('course:id,name')->get();

        return response()->json(['success' => true, 'message' => 'list all assignment', 'data' => $assign], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request)
    {
        $data = $request->safe()->all();

        Assignment::create([
            'title' => $data['title'],
            'course_id' => $data['course_id'],
            'description' => $data['description'],
            'deadline' => $data['deadline']
        ]);


        return response()->json([
            'success' => true,
            'message' => 'create assignment successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assigment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assigment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assigment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assigment)
    {
        //
    }
}
