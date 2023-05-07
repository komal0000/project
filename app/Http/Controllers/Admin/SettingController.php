<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /*
    *0 for image
    *1 for text
    *2 for text area
    */
    const Setting = [
        'top' => [
            "Header Setting", [
                ['address', 1],
                ['opening', 1],
                ['phone', 1],
                ['email', 1],
                ['logo', 0],
                ['fabicon', 0],
            ],
            [
                ["top", "views/front/includes/top.blade.php"],
                ["icon", "views/front/includes/icon.blade.php"],
            ]
        ],
        'social' => [
            "Social Links", [
                ['Facebook', 1],
                ['Twitter', 1],
                ['Instagram', 1],
                ['Youtube', 1],

            ],
            [
                ["footersocial", "views/front/includes/footersocial.blade.php"],
                ["headersocial", "views/front/includes/headersocial.blade.php"],
            ]
        ],
        'copy' => [
            "CopyRight", [
                ['copyright', 1],
            ]
        ],
        'homeabout' => [
            "About Us",
            [
                ['img', 0],
                ['title', 1],
                ['desc', 2],
                ['story', 2],
                ['mission', 2],
                ['vision', 2],
            ],
            "views/front/pages/home/about.blade.php"

        ],
        'homefacts' => [
            "Home Facts",
            [
                ['icon1', 1], ['num1', 1], ['title1', 1],
                ['icon2', 1], ['num2', 1], ['title2', 1],
                ['icon3', 1], ['num3', 1], ['title3', 1],
                ['icon4', 1], ['num4', 1], ['title4', 1],

            ],
            "views/front/pages/home/facts.blade.php"

        ],
        'homefeature' => [
            "Home Feature",
            [
                ['subtitle', 1],
                ['title', 1],
                ['desc', 2],
                ['url', 1],
                ['title1', 1], ['desc1', 2], ['url1', 1],
                ['title2', 1], ['desc2', 2], ['url2', 1],
                ['title3', 1], ['desc3', 2], ['url3', 1],

            ],
            "views/front/pages/home/features.blade.php"

        ],
        'connect' => [
            "Connect",
            [
                ['address', 1],
                ['phonno', 1],
                ['email', 1],
            ],
            "views/front/pages/home/connect.blade.php"
        ],
        'aboutus' => [
            "About us",
            [
                ['title', 1],
                ['sdesc', 2],
                ['desc', 2],
            ],
            "views/front/pages/home/aboutus.blade.php"
        ],
        'intro' => [
            "Intro",
            [
                ['Title', 1],
                ['Number', 1],
                ['Sdesc', 1],
                ['Title1', 1],
                ['Desc1', 2],
                ['Sdesc1', 2],
            ],
            "views/front/pages/home/whoarewe.blade.php"
        ],
    ];


    public function index($type, Request $request)
    {
        $data = self::Setting[$type];
        $curdata = [];
        if ($request->getMethod() == "POST") {
            foreach ($data[1] as $key => $attr) {
                $k = $type . '_' . $attr[0];
                try {
                    if (($attr[1] == 0)) {
                        $s = setSetting($k, $request->file($k)->store('uploads/settings'), true);
                    } else {
                        $s = setSetting($k, $request->input($k), true);
                    }
                    $curdata[$attr[0]] = $s->value;
                } catch (\Throwable $th) {
                    $curdata[$attr[0]] = getSetting($k, true);
                }
            }
            if (isset($data[2])) {
                if (is_array($data[2])) {
                    foreach ($data[2] as $key => $pathData) {
                        file_put_contents(resource_path($pathData[1]), view('admin.setting.template.' . $pathData[0], compact('curdata'))->render());
                    }
                } else {

                    file_put_contents(resource_path($data[2]), view('admin.setting.template.' . $type, compact('curdata'))->render());
                }
            } else {
                file_put_contents(resource_path('views/front/includes/' . $type . '.blade.php'), view('admin.setting.template.' . $type, compact('curdata'))->render());
            }
            return redirect()->back();
        } else {
            return view('admin.setting.index', compact('data', 'type'));
        }
    }

    public function meta(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $data = getSetting('meta') ?? ((object)([
                'desc' => '',
                'image' => '',
                'keyword' => '',
                'title' => '',
            ]));
            // dd($data);

            return view('admin.setting.meta', compact('data'));
        } else {
            $olddata = getSetting('meta') ?? ((object)([
                'desc' => '',
                'image' => '',
                'keyword' => '',
                'title' => ','
            ]));
            $data = [
                'desc' => $request->desc,
                'keyword' => $request->keyword,
                'image' => $request->hasFile('image') ? $request->image->store('uploads/settings') : $olddata->image,
                'title' => $request->title,
            ];
            setSetting('meta', $data);
            file_put_contents(resource_path('views/front/include/meta.blade.php'), view('admin.setting.template.meta')->render());
            file_put_contents(resource_path('views/front/include/title.blade.php'), view('admin.setting.template.meta1')->render());
            return redirect()->back()->with('message', "Setting Saved Sucessfully");
        }
    }

    public function homepage(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $data = getSetting('homepage') ?? ((object)([
                'program' => '',
                'why' => '',
                'event' => '',
                'news' => '',
                'about' => [],
                'about_title' => [],

            ]));
            // dd($data);
            $abouts = DB::table('pages')->where('type', 'about')->orWhere('type', 'msg')->select('id', 'title')->get();
            return view('admin.setting.homepage', compact('data', 'abouts'));
        } else {
            $about = [];
            if ($request->filled('about')) {
                foreach ($request->about as $key => $abt) {
                    $about['about_' . $abt] = [
                        'id' => $abt,
                        'title' => $request->filled('about_' . $abt) ? $request->input('about_' . $abt) : 'About Us'
                    ];
                }
            }
            $data = [
                'program' => $request->program,
                'why' => $request->why,
                'event' => $request->event,
                'news' => $request->news,
                'about' => $request->about ?? [],
                'about_title' => $about,
            ];
            setSetting('homepage', $data);
            return redirect()->back()->with('message', "Setting Saved Sucessfully");
        }
    }

    public function contact(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $data = getSetting('contact') ?? ((object)([
                'map' => '',
                'email' => '',
                'phone' => '',
                'addr' => '',
                'others' => [],

            ]));
            return view('admin.setting.contact', compact('data'));
        } else {
            $others = [];
            if ($request->filled('others')) {
                foreach ($request->others as $key => $other) {
                    array_push($others, [
                        'name' => $request->input('name_' . $other) ?? '',
                        'phone' => $request->input('phone_' . $other) ?? '',
                        'designation' => $request->input('designation_' . $other) ?? '',
                        'email' => $request->input('email_' . $other) ?? '',
                    ]);
                }
            }
            $data = [
                'map' => $request->map ?? '',
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '',
                'addr' => $request->addr ?? '',
                'others' => $others
            ];
            setSetting('contact', $data);
            file_put_contents(resource_path('views/front/include/address.blade.php'), view('admin.setting.template.contactfooter')->render());
            file_put_contents(resource_path('views/front/include/map.blade.php'), view('admin.setting.template.contactmapfooter')->render());

            return redirect()->back()->with('message', "Setting Saved Sucessfully");
        }
    }

    public function about(Request $request)
    {
        if ($request->getMethod() == "POST") {
            setSetting('main_msg', $request->main_msg);
            $mainMsg = getSetting('main_msg') ?? -1;

            $data = DB::table('pages')->where('id', $mainMsg)->first();
            $data->desc = json_decode($data->desc);
            // dd($data);
            $abouts = DB::table('pages')->where('type', 'about')->orderBy('created_at', 'desc')->paginate(10);
            file_put_contents(resource_path('views/front/pages/partials/about.blade.php'), view('admin.page.template.about', compact('abouts', 'data'))->render());
            return redirect()->back();
        } else {
            $datas = DB::table('pages')->where('type', 'msg')->get(['id', 'title']);
            $mainMsg = getSetting('main_msg');
            return view('admin.setting.about', compact('mainMsg', 'datas'));
        }
    }
}
