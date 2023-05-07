<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    public function indexType()
    {
        $types = TeamType::where('parent_id', 0)->with('childs')->get(['id', 'name']);
        // dd($types);
        return view('admin.team.type', compact('types'));
    }

    public function addType(Request $request)
    {
        $type = new TeamType();
        $type->name = $request->name;
        $type->parent_id = $request->parent_id ?? 0;
        $type->save();
        $this->render();

        return redirect()->back()->with('message', 'Team Type Added Sucessfully');
    }
    public function editType(Request $request, TeamType $type)
    {
        $type->name = $request->name;

        $type->save();
        $this->render();

        // dd($type);
        return redirect()->back()->with('message', 'Team Type Updated Sucessfully');
    }

    public function delType(Request $request, TeamType $type)
    {
        if ($type->parent_id == 0) {
            TeamType::where('parent_id', $type->id)->update(['parent_id' => null]);
        }

        $type->delete();
        $this->render();

        return redirect()->back()->with('message', 'Team Type Deleted Sucessfully');
    }

    public function index(TeamType $type)
    {
        return view('admin.team.index', compact('type'));
    }
    public function add(Request $request, TeamType $type)
    {
        if ($request->getMethod() == "POST") {
            $team = new Team();
            $team->name = $request->name;
            $team->email = $request->email;
            $team->phone = $request->phone;
            $team->image = $request->image->store('uploads/team');
            $team->designation = $request->designation;
            $team->desc = $request->desc;
            $team->addr = $request->addr;
            $team->li = $request->li;
            $team->tw = $request->tw;
            $team->fb = $request->fb;
            $team->sn = $request->SN ?? 0;
            $team->team_type_id = $type->id;
            // $team->extra=$request->extra??'';
            $team->save();
            $this->render();

            return response()->json(['status' => true]);
        } else {
            return view('admin.team.add', compact('type'));
        }
    }

    public function edit(Request $request, Team  $team)
    {
        if ($request->getMethod() == "POST") {
            $team->email = $request->email;
            $team->phone = $request->phone;
            if ($request->hasFile('image')) {
                $team->image = $request->image->store('uploads/team');
            }
            $team->designation = $request->designation;
            $team->desc = $request->desc;
            $team->addr = $request->addr;
            $team->li = $request->li;
            $team->tw = $request->tw;
            $team->fb = $request->fb;
            $team->sn = $request->SN ?? 0;
            $team->save();
            $this->render();
            return response()->json(['status' => true]);
        } else {
            return view('admin.team.edit', compact('team'));
        }
    }

    public function render()
    {
        $teamTypes = DB::table('team_types')->get();
        if ($teamTypes->count() == 0) {
            File::delete(resource_path('views/front/pages/team/home.blade.php'));
            File::delete(resource_path('views/front/pages/team/list.blade.php'));
        } else {
            $teams = DB::table('teams')->get();
            $main = env('board', -1);
            if ($main == -1) {
                $mainTeamType = $teamTypes->first();
            } else {
                $mainTeamType = $teamTypes->where('id', $main)->first();
            }

            if ($mainTeamType == null) {
                $mainTeamType = $teamTypes->first();
            }
            $mainTeams = $teams->where('team_type_id', $mainTeamType->id)->take(5)->sortByDesc('sn')->values();

            file_put_contents(resource_path('views/front/pages/team/home.blade.php'), view('admin.team.template.home', compact('mainTeamType', 'mainTeams'))->render());
            file_put_contents(resource_path('views/front/pages/team/list.blade.php'), view('admin.team.template.list', compact('teamTypes', 'teams'))->render());
            File_put_contents(resource_path('views/front/pages/team/info.blade.php'), view('admin.team.template.info', compact('teams'))->render());
        }
    }
}
