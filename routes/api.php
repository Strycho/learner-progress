use App\Http\Controllers\Api\LearnerProgressController;

Route::get('/learners', [LearnerProgressController::class, 'index']);
