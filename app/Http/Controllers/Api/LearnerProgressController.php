<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\LearnerResource;
use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Course;

class LearnerProgressController extends Controller
{
    // Method to return the JSON API data
    public function apiIndex(Request $request)
    {
        $courseFilter = $request->query('course');

        $query = Learner::with(['enrolments.course']);
        if ($courseFilter) {
            $query->filterByCourse($courseFilter);
        }

        $learners = $query->get();
        return LearnerResource::collection($learners);
    }

    // Method to return the Blade view with learners data for server-side rendering
    public function index()
    {
        $courses = Course::orderBy('name')->get();
        return view('learner-progress', compact('courses'));
    }
}
