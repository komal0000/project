<?php

namespace App\Http\Controllers\Admin;

use App\Data;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    //
    public function index($type)
    {
        $pages = DB::table('pages')->where('type', $type)->select(['id', 'title'])->get();
        $pageType = Data::pageTypes[$type];
        return view('admin.page.index', compact('type', 'pages', 'pageType'));
    }

    public function add($type, Request $request)
    {
        $pageType = Data::pageTypes[$type];
        // dd($pageType);
        if ($request->getMethod() == "POST") {
            $page = new Page();
            $page->title = $request->title;
            $page->short_desc = $request->short_desc ?? '';

            if (count($pageType[2]) > 0) {
                $data = [];
                foreach ($pageType[2] as $key => $descType) {
                    $data[$key] = $request->input($key) ?? "";
                }
                $page->desc = json_encode($data);
            } else {
                $page->desc = $request->desc ?? '';
            }
            $page->type = $type;

            if ($request->hasFile('photo')) {
                $page->image = $request->photo->store('uploads/page/' . Carbon::now()->format('Y/m/d'));
            } else {
                $page->image = '';
            }
            $page->save();

            $files = [];
            if ($request->filled('docs')) {
                foreach ($request->docs as $key => $doc) {
                    if ($request->hasFile('doc_image_' . $doc)) {
                        $d = new PageUpload();
                        $d->title = $request->input('doc_name_' . $doc);
                        $d->file = $request->file('doc_image_' . $doc)->store('uploads/page/' . getIDPath($page->id));
                        $d->page_id = $page->id;
                        $d->save();
                        array_push($files, $d);
                    }
                }
            }
            $this->render($type);

            return redirect()->back()->with('message', "{$pageType[0]} Added Sucessfully");
        } else {
            return view('admin.page.add', compact('type', 'pageType'));
        }
    }

    public function edit(Page $page, Request $request)
    {
        $pageType = Data::pageTypes[$page->type];
        if ($request->getMethod() == "POST") {
            $page->title = $request->title;
            $page->short_desc = $request->short_desc;

            if (count($pageType[2]) > 0) {
                $data = [];
                foreach ($pageType[2] as $key => $descType) {
                    $data[$key] = $request->input($key) ?? "";
                }
                $page->desc = json_encode($data);
            } else {
                $page->desc = $request->desc ?? '';
            }

            if ($request->hasFile('photo')) {
                $page->image = $request->photo->store('uploads/page/' . Carbon::now()->format('Y/m/d'));
            }
            $page->save();

            $files = [];
            if ($request->filled('docs')) {
                foreach ($request->docs as $key => $doc) {
                    if ($request->hasFile('doc_image_' . $doc)) {
                        $d = new PageUpload();
                        $d->title = $request->input('doc_name_' . $doc);
                        $d->file = $request->file('doc_image_' . $doc)->store('uploads/page/' . getIDPath($page->id));
                        $d->page_id = $page->id;
                        $d->save();
                        array_push($files, $d);
                    }
                }
            }
            $this->render($page->type);

            return redirect()->back()->with('message', "{$pageType[0]} Updated Sucessfully");
        } else {
            return view('admin.page.edit', compact('page', 'pageType'));
        }
    }

    public function del(Page $page)
    {

        $pageType = Data::pageTypes[$page->type];
        $type = $page->type;
        $this->render($type);
        $page->delete();
        return redirect()->back()->with('message', "{$pageType[0]} Deleted Sucessfully");
    }
    public function delDoc(Request $request)
    {
        $file = PageUpload::find($request->id);
        $file->delete();
    }

    public function render($type)
    {
        switch ($type) {
            case 'not':

                $notices = DB::table('pages')->where('type', $type)->orderBy('created_at', 'desc')->take(4)->get();
                file_put_contents(resource_path('views/front/pages/home/notice.blade.php'), view('admin.page.template.notice', compact('notices'))->render());
                break;
            case 'about':
                $mainMsg = getSetting('main_msg') ?? -1;
                $data = DB::table('pages')->where('id', $mainMsg)->first();
                if ($data != null) {
                    $data->desc = json_decode($data->desc);
                }
                $abouts = DB::table('pages')->where('type', $type)->orderBy('created_at', 'desc')->paginate(10);
                file_put_contents(resource_path('views/front/pages/partials/about.blade.php'), view('admin.page.template.about', compact('abouts', 'data'))->render());
                break;
            case 'news':
                $news = DB::table('pages')->where('type', $type)->orderBy('created_at', 'desc')->get();
                // dd($news);
                file_put_contents(resource_path('views/front/pages/template/news.blade.php'), view('admin.page.template.news', compact('news'))->render());
                file_put_contents(resource_path('views/front/pages/list/news.blade.php'), view('admin.page.template.list.news', compact('news'))->render());
                file_put_contents(resource_path('views/front/pages//home/news.blade.php'), view('admin.page.template.home.news', compact('news'))->render());
                break;

            case 'story':
                $stories = DB::table('pages')->where('type', $type)->orderBy('created_at', 'desc')->get();
                foreach ($stories as $story) {
                    // dd($story);
                    $story->data = json_decode($story->desc);
                    if ($story->data->type == "main") {
                        file_put_contents(resource_path('views/front/pages/template/story.blade.php'), view('admin.page.template.story', compact('story'))->render());
                        break;
                    }
                }
                file_put_contents(resource_path('views/front/pages/list/story.blade.php'), view('admin.pagse.template.list.story', compact('stories'))->render());
                break;

                // case 'intro':
                //     $intros = DB::table('pages')->where('type', $type)->orderBy('created_at', 'desc')->get();
                //     // dd($intro);
                //     foreach ($intros as $intro) {
                //         $intro->data = json_decode($intro->desc);
                //         file_put_contents(resource_path('views/front/pages/template/whoarewe.blade.php'), view('admin.page.template.whoarewe', compact('intro'))->render());
                //         break;
                //     }
            default:
                break;
        }
    }
}
