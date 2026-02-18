<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with([
            'lecturer:id,name',
            'students:id,name',
            'materials:id,title,file_path,course_id',
            'assignments:id,title,course_id',
            'discussions:id,content,course_id'
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'list all courses',
            'data' => $courses
        ], 200);
    }

    public function indexTrash()
    {
        $courses = Course::onlyTrashed()->with('lecturer:id,name')->get();

        return response()->json([
            'success' => true,
            'message' => 'list all trash courses',
            'data' => $courses
        ], 200);
    }

    public function indexEnroll()
    {
        $users = User::where('role', 'student')
            ->with('hasCourse')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'list enroll courses',
            'data' => $users
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
    public function store(StoreCourseRequest $request)
    {
        $data = $request->safe()->all();
        Course::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'lecturer_id' => $data['lecturer_id']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'create courses successfully'
        ], 201);
    }

    public function enroll(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        $user = $request->user();

        $course->students()->syncWithoutDetaching($user->id);

        return response()->json([
            'success' => true,
            'message' => 'enroll courses successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        $data = $request->safe()->all();

        $course->name = $data['name'];
        $course->description = $data['description'];
        $course->lecturer_id = $data['lecturer_id'];

        $course->save();

        return response()->json([
            'success' => true,
            'message' => 'update courses successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'delete courses successfully'
        ], 200);
    }
}
