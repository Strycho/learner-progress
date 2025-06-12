<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
    ];
    public function enrolments()
    {
        return $this->hasMany(Enrolment::class);
    }

    
    public function scopeFilterByCourse($query, $courseName)
    {
        return $query->whereHas('enrolments.course', function ($q) use ($courseName) {
            $q->where('name', $courseName);
        });
    }
}
