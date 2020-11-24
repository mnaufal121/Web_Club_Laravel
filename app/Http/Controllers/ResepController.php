<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ResepController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('reseps')->join('categories', 'reseps.id_category', 'categories.id')
                ->select('reseps.*', 'categories.category')->orderBy('reseps.id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'resep.action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('resep.index');
    }

    public function create()
    {
        return view('resep.create');
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

    public function store(Request $request)
    {
        $request->validate(['gambar' => 'required|max:2048|mimes:jpg,jpeg,png']);
        $foto = $request->file('gambar');
        $nameFoto = md5(time()) . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('gambar'), $nameFoto);
        $resep = new Resep;
        $resep->id_category = $request->id_category;
        $resep->judul = $request->judul;
        $resep->resep = $request->resep;
        $resep->gambar = $nameFoto;
        $resep->save();
        return Redirect::to('resep')->with('success', 'Resep has been created successfully.');
    }

    public function show($id)
    {
        return view('resep.show', compact('resep'));
    }

    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        return view('resep.edit', compact('resep'));
    }

    public function update(Request $request, $id)
    {
        $resep = resep::findOrFail($id);
        $resep->id_category = $request->id_category;
        $resep->judul = $request->judul;
        $resep->resep = $request->resep;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $n = $file->getClientOriginalName();
            $name = "$n";
            $file->move(public_path() . '/gambar', $name);
            $photo = $name;
        } else {
            $photo = $resep->gambar;
        }
        $resep->gambar = $photo;
        $resep->save();
        return Redirect::to('resep')
            ->with('success', 'Resep Has Been updated successfully');
    }

    public function destroy(Request $request)
    {
        $res = Resep::where('id', $request->id)->delete();
        return Response()->json($res);
    }
}
