<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Learner;

class LearnerProgressController extends Controller
{
    // Method to return the JSON API data
    public function apiIndex()
    {
        $learners = Learner::with(['enrolments.course'])->get();

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
        $learners = Learner::with(['enrolments.course'])->get();

        return view('learner-progress', compact('learners'));
    }
}
