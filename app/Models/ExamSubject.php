<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    use HasFactory;

    public function partials(){
        return $this->hasMany(ExamSubjectParts::class);
    }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
