<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LearnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->firstname . ' ' . $this->lastname,
            'courses' => $this->enrolments->pluck('course.name')->toArray(),
            'progress' => round($this->enrolments->avg('progress') ?? 0),
        ];
    }
}
