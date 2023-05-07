<?php

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$defaults=["asdf","asdfs"];
$imageExtensions = array(
    'jpg',
    'jpeg',
    'png',
    'gif',
    'bmp',
    'webp',
    'svg',
    'ico',
    'tif',
    'tiff',
    'jif',
    'jfif',
    'jp2',
    'jpx',
    'j2k',
    'j2c',
    'xbm',
    'wbmp',
    'bmp',
    'dib'
);
function def($name)  {
    return \App\Data::data[$name];
}


function getIDPath($id){
      return implode('/', str_split(sprintf("%09d", $id),3));
}

function getSetting($key,$direct=false){
    $s=DB::table('settings')->where('key',$key)->select('value')->first();
    return $direct?($s!=null?$s->value:null):($s!=null?json_decode($s->value):null);
}

function setSetting($key,$value,$direct=false){
    $s=Setting::where('key',$key)->first();
    if($s==null){
        $s=new Setting();
        $s->key=$key;
    }
    if($direct){
        $s->value=$value;
    }else{

        $s->value=json_encode($value);
    }
    $s->save();
    return $s;
}


function getGroupedSetting($key,$direct=true){
    $config=[$key,$direct];
    return DB::table('settings')->where('key','like',$key.'_%')->get()->map(function($setting) use ($config) {
        return [
            str_replace($config[0].'_',"",$setting->key)=> $config[1]?$setting->value:json_decode($setting->value)
        ];
    });

}


function makeDate($d){
    $n=Carbon::parse($d);
    return $n->format('Y-m-d');
}

function createMeta($data) {
    $meta = '<meta name="description" content="' . $data->short_desc . '">';

    if (!empty($data->title)) {
        $meta .= '<meta property="og:title" content="' . $data->title . '">';
        $meta .= '<meta name="twitter:title" content="' . $data->title . '">';
    }

    if (!empty($data->desc)) {
        $meta .= '<meta property="og:description" content="' . strip_tags($data->desc) . '">';
        $meta .= '<meta name="twitter:description" content="' . strip_tags($data->desc) . '">';
    } else {
        $meta .= '<meta property="og:description" content="' . $data->short_desc . '">';
        $meta .= '<meta name="twitter:description" content="' . $data->short_desc . '">';
    }

    if (!empty($data->image)) {
        $meta .= '<meta property="og:image" content="' . $data->image . '">';
        $meta .= '<meta name="twitter:image" content="' . $data->image . '">';
    }

    $meta .= '<meta property="og:type" content="article">';

    return $meta;
}

function createMetaTeam($data) {
    $title = $data->name;
    $description = $data->designation;
    $image = asset($data->image);
    $url = url()->current();
    $type = 'article';

    $tags = [
        '<meta name="title" content="' . $title . '">',
        '<meta name="description" content="' . $description . '">',
        '<meta property="og:image" content="' . $image . '">',
        '<meta property="og:url" content="' . $url . '">',
        '<meta property="og:type" content="' . $type . '">'
    ];

    return implode("\n", $tags);
}

function isImageFile($fileName) {
    $imageExtensions = array(
        'jpg',
        'jpeg',
        'png',
        'gif',
        'bmp',
        'webp',
        'svg',
        'ico',
        'tif',
        'tiff',
        'jif',
        'jfif',
        'jp2',
        'jpx',
        'j2k',
        'j2c',
        'xbm',
        'wbmp',
        'bmp',
        'dib'
    );

    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    return in_array(strtolower($fileExtension), $imageExtensions);
}

function getLatestNews($id){
    return DB::table('pages')
    ->where('type','news')
    ->orderBy('id','desc')
    ->where('id','<>',$id)->take(4)->get(['id','title','image','short_desc']);
}
