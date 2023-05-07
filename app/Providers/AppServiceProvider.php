<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $datePath=storage_path('logs'.'/'.date("Y/m/d"));
        File::ensureDirectoryExists($datePath);

        DB::listen(function ($query) use($datePath) {
            $sql=trim($query->sql," \t\n\r\0\x0B()");
            if( !str_starts_with(strtolower( $sql),"select")  ){
                try {

                    $fp = fopen($datePath . '/data.txt', 'a');
                    fwrite($fp,json_encode([date("Y,m,d h:i:s"),$sql, $query->bindings, $query->time]).PHP_EOL);
                    fclose($fp);
                    } catch (\Throwable $th) {
                }
            }else{

                    $fp = fopen($datePath . '/select.txt', 'a');
                    fwrite($fp,json_encode([date("Y,m,d h:i:s"),$sql, $query->bindings, $query->time,str_replace('/','->',request()->path())]).PHP_EOL);
                    fclose($fp);

            }
        });
    }
}
