<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscussionRequest;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateDiscussionRequest;
use App\Models\Discussion;
use App\Models\Reply;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discuss = Discussion::with(['course:id,name', 'replies'])->get();

        return response()->json([
            'success' => true,
            'message' => 'discussion list successfully',
            'data' => $discuss
        ], 200);
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
    public function store(StoreDiscussionRequest $request)
    {
        $data = $request->safe()->all();

        $user = $request->user();

        Discussion::create([
            'course_id' => $data['course_id'],
            'user_id' => $user->id,
            'content' => $data['content']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'discussion create successfully'
        ], 201);
    }

    public function reply(StoreReplyRequest $request)
    {
        $data = $request->safe()->all();

        $user = $request->user();

        Reply::create([
            'discussion_id' => $data['discussion_id'],
            'user_id' => $user->id,
            'content' => $data['content']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'reply create successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscussionRequest $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        //
    }
}
