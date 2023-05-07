<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public function childs()
    {
        return Menu::where('parent_id',$this->id)->orderBy('sn','asc')->get();
    }
}
