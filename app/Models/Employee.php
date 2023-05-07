<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Employee extends Model
{
    use HasFactory,UserStamps;

    protected $casts=[
        'dob'=>'date',
        'joining_date'=>'date',
    ];
}
