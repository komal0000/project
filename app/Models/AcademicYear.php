<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class AcademicYear extends Model
{
    use HasFactory,UserStamps;
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
