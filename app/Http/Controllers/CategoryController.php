<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = DB::table('categories')->select('categories.*')
            ->orderBy('categories.id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'category.action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate(['category' => 'required',]);
        $category = new Category;
        $category->category = $request->category;
        $category->save();
        return redirect()->route('category.index')
        ->with('success', 'Category has been created successfully.');
    }

    public function show($id)
    {
        return view('category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['category' => 'required',]);
        $category = Category::find($id);
        $category->category = $request->category;
        $category->save();
        return redirect()->route('category.index')
        ->with('success', 'Category Has Been updated successfully');
    }

    public function destroy(Request $request)
    {
        $cat = Category::where('id',$request->id)->delete(); 
        return Response()->json($cat);
    }
}
