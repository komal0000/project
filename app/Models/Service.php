<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(ServiceType::class,'service_type_id','id');
    }
}
