<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=category::paginate(10);
        return view('Categories.categories',compact('categories'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'name'=>'required|string',
        ]);
        category::create([
        'name'=>$request->name,
        'id'=>$request->id,

        ]);
        return redirect()->route('category.index');}
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show(category $category)
    {
        //
    }


    public function edit(category $category)
    {
        //
    }


    public function update(Request $request)
    {
    try{
        $request->validate([
            'name'=>'required|string',
        ]);

        $row =category::with('post')->FindOrFail($request->id);
        $row->Update([
        'name'=>$request->name,
        ]);

        return redirect()->route('category.index');}
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        $row =category::with('post')->FindOrFail($request->id);
    $row->delete();
    return redirect()->route('category.index');
    }
}
