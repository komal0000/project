<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeMail extends Model
{
    use HasFactory;
    protected $fillable=[
        'emails',
        'subject',
        'mail'
    ];
}
