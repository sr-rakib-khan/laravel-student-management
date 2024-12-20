<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'section_name',
        'schedule_day',
        'schedule_time',
        'status',
    ];



    function course()
    {
        return $this->belongsTo(Course::class);
    }
}
