<?php

use App\Models\Download;
use App\Models\DownloadType;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('make:admin', function () {
    $user=new User();
    $user->name="Admin";
    $user->email="admin@sabalskkss.com.np";
    $user->password=bcrypt('dwZuXUUlOYdn1Vp8');
    $user->save();
})->purpose('Seeding downloads');
