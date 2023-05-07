<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    //
    public function index()
    {
        $menus = DB::select("select id,name,is_header,link,sn, (select group_concat(id,'|',name,'|',link,'|',sn ) from menus where parent_id=m.id) as childs from menus m where parent_id is null");
        $pages = DB::table('pages')->select('id', 'type', 'title')->get();
        $galleries = DB::table('gallery_types')->select('id', 'name')->get();
        // $events = DB::table('events')->select('id', 'title')->latest()->get();
        $teams = DB::table('team_types')->select('id', 'name')->latest()->get();
        return view('admin.menu.index', compact('menus', 'pages','galleries','teams'));
    }

    public function del(Request $request)
    {
        $menu = Menu::find($request->id);
        if($menu!=null){
            if(Menu::where('parent_id',$menu->id)->count()>0){
                throw new \Exception("Menu Has Other Sub Menuitems.", 1);

            }else{
                $menu->delete();
                $this->render();

            }
        }else{
            throw new \Exception("Menu Not Found", 1);

        }
    }

    public function edit(Request $request)
    {
        $menu = Menu::find($request->id);
        $menu->name = $request->name;
        $menu->sn = $request->sn;

        switch ($request->type) {
            case 3:
                $menu->link = $request->extra_links;
                break;
            default:
                $menu->link = $request->links;
                break;
        }
        $menu->save();
        $this->render();
        return response()->json($menu);
    }

    public function add(Request $request)
    {
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->sn = $request->sn??0;

        $menu->parent_id = $request->parent_id != 0 ? $request->parent_id : null;
        switch ($request->type) {
            case 1:
                $menu->link = '#';
                $menu->is_header = true;
                break;

            case 3:
                $menu->link = $request->extra_links;
                $menu->is_header = false;
                break;
            default:
                $menu->link = $request->links;
                $menu->is_header = false;
                break;
        }
        $menu->save();

        $this->render();
        return response()->json($menu);
    }

    public function render()
    {
        $menus=Menu::whereNull('parent_id')->orderBy('sn','asc')->get();
        file_put_contents( resource_path('views/front/layout/menu.blade.php'),view('admin.menu.template',compact('menus'))->render());
    }


}
