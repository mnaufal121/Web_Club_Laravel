<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;


class VideoController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('videos')
                ->join('categories', 'videos.id_category', 'categories.id')
                ->select('videos.*', 'categories.category')
                ->orderBy('videos.id', 'desc')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', 'video.action')->rawColumns(['action'])->make(true);
        }
        return view('video.index');
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $video = new Video;
        $video->id_category = $request->id_category;
        $video->judul = $request->judul;
        $video->video = $request->video;
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video has been created successfully.');
    }

    public function getCategory(Request $r)
    {
        $s = Category::where('id', '>', '0');
        if ($r->q) {
            $s = $s->where('category', 'LIKE', '%' . $r->q . '%');
        }
        $s = $s->get();
        return response()->json($s);
    }

    public function show($id)
    {
        return view('video.show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['id_category' => 'required', 'judul' => 'required', 'video' => 'required',]);
        $video = Video::find($id);
        $video->id_category = $request->id_category;
        $video->judul = $request->judul;
        $video->video = $request->video;
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video Has Been updated successfully');
    }

    public function destroy(Request $request)
    {
        $vid = Video::where('id', $request->id)->delete();
        return Response()->json($vid);
    }
}
