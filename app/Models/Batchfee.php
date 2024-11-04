<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batchfee extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'feehead_id',
        'fee_name',
        'fee_amount',
    ];
}
