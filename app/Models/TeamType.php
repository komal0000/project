<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamType extends Model
{
    use HasFactory;
    public function childs(){
        return $this->hasMany(TeamType::class,'parent_id','id');
    }

    public function people()
    {
        return $this->hasMany(Team::class,'team_type_id','id');
    }

    public function getPeople()
    {
        return Team::where('team_type_id',$this->id)->get(['id','name','phone']);
    }

    public function minPeople()
    {
        return Team::where('team_type_id',$this->id)->orderBy('sn','asc')->take(4)->get();
    }
}
