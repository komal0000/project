<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','file','download_type_id'
    ];

    public function getExt(){
        $index = strrpos($this->file,'.')+1;
        return substr($this->file,$index,strlen($this->file)-$index);
    }
}
