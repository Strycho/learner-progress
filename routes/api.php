<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LearnerProgressController;

Route::get('/learners', [LearnerProgressController::class, 'apiIndex']);