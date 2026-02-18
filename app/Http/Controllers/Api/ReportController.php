<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Builder;

class ReportController extends Controller
{
    public function courses()
    {
        $courses = Course::select('id', 'name', 'description')->withCount('students')->get();

        return response()->json([
            'success' => true,
            'message' => 'list student per course',
            'data' => $courses
        ], 200);
    }

    public function assignments()
    {

        $assignments = Assignment::select('id', 'title', 'deadline', 'course_id')
            ->with('course:id,name')
            ->withCount([
                'submissions',
                'submissions as graded_count' => function (Builder $query) {
                    $query->whereNotNull('score');
                },
                'submissions as ungraded_count' => function (Builder $query) {
                    $query->whereNull('score');
                },
            ])->get();


        return response()->json([
            'success' => true,
            'message' => 'report grade assignment',
            'data' => $assignments
        ], 200);
    }

    public function student($id)
    {

        $submission = Submission::select('id', 'assignment_id', 'student_id', 'score', 'file_path')->with('assignment:id,title,deadline', 'student:id,name')->where('student_id', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'report grade assignment',
            'data' => $submission
        ], 200);
    }
}
