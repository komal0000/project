<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Level extends Model
{
    use HasFactory,UserStamps;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
