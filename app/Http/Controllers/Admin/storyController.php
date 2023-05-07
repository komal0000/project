<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\story;
use Illuminate\Http\Request;

class storyController extends Controller
{
    public function index(Request $request)
    {
        $stories = story::all();
        return view('admin.story.index', compact('stories'));
    }
    public function add(Request $request)
    {
        if ($request->getmethod() == "POST") {
            $story = new story();
            $story->title = $request->title;
            $story->stitle = $request->stitle;
            $story->sdesc = $request->sdesc;
            $story->desc = $request->desc;
            $story->image = $request->image->store('uploads/story');
            $story->save();
            return redirect()->back()->with('messege', "Added");
        } else {
            return view('admin.story.add');
        }
    }
    public function edit(Request $request, story $story)
    {
        if ($request->getmethod() == "POST") {
            $story->title = $request->title;
            $story->stitle = $request->stitle;
            $story->sdesc = $request->sdesc;
            $story->desc = $request->desc;
            if ($request->hasFile('image')) {
                $story->image = $request->image->store('uploads/story');
            }
            $story->save();
            return redirect()->back()->with('messege', "Edited");
        } else {
            return view('admin.story.edit', compact('story'));
        }
    }
    public function del(Request $request, story $story)
    {
        $story->delete();
        return redirect()->back()->with('messege', 'Deleted');
    }
}
