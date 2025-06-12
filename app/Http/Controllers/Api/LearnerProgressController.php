<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Learner;

class LearnerProgressController extends Controller
{
    public function index()
    {
        $learners = Learner::with(['enrolments.course'])->get();

        $results = $learners->map(function ($learner) {
            $courses = $learner->enrolments->pluck('course.name')->toArray();
            $progress = $learner->enrolments->avg('progress') ?? 0;

            return [
                'name' => $learner->name,
                'courses' => $courses,
                'progress' => round($progress),
            ];
        });

        return response()->json($results);
    }
}
