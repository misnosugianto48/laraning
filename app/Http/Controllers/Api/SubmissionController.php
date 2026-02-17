<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSubmissionRequest $request)
    {
        $data = $request->safe()->all();

        if ($request->hasFile('file_path')) {
            $path = Storage::disk('public')->putFile('submissions', $request->file('file_path'), 'public');
        }

        $user = $request->user();

        Submission::create([
            'assignment_id' => $data['assignment_id'],
            'student_id' => $user->id,
            'file_path' => $path
        ]);

        return response()->json([
            'success' => true,
            'message' => 'upload submission successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, $id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        $data = $request->safe()->all();

        $submission->score = $data['score'];
        $submission->save();

        return response()->json([
            'success' => true,
            'message' => 'grading submission successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
