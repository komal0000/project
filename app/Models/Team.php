<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public function type()
    {
        return $this->belongsTo(TeamType::class,'team_type_id','id');
    }
}
