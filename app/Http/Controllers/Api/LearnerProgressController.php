<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Course;
use App\Models\Enrolment;

class LearnerProgressController extends Controller
{
    // Method to return the JSON API data
    public function apiIndex(Request $request)
    {
        $courseFilter = $request->query('course');

        $query = Learner::with(['enrolments.course']);

        if ($courseFilter) {
            $query->whereHas('enrolments.course', function ($q) use ($courseFilter) {
                $q->where('name', $courseFilter);
            });
        }

        $learners = $query->get();
        $results = $learners->map(function ($learner) {
            $courses = $learner->enrolments->pluck('course.name')->toArray();
            $progress = $learner->enrolments->avg('progress') ?? 0;

            return [
                'name' => $learner->firstname . ' ' . $learner->lastname,
                'courses' => $courses,
                'progress' => round($progress),
            ];
        });

        return response()->json($results);
    }

    // Method to return the Blade view with learners data for server-side rendering
    public function index()
    {
        $courses = Course::orderBy('name')->get();
        return view('learner-progress', compact('courses'));
    }
}
