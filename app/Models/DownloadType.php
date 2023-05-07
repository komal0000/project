<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadType extends Model
{
    use HasFactory;
    public function childs(){
        return $this->hasMany(DownloadType::class,'parent_id','id');
    }

    public function downloads()
    {
        return $this->hasMany(Download::class,'download_type_id','id');
    }

    public function hasDownload()
    {
        return Download::where('download_type_id',$this->id)->count()>0;
    }
}
