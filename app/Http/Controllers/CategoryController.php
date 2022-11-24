<?php

namespace App\Http\Controllers;

use App\Models\category;
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
    {try{
        $data=[
            'category_name'=>'required|string',
        ];
        $validated=$request->validate($data);
        category::create([
        'category_name'=>$request->category_name,
        ]);
        return redirect()->route('category.index');}
        catch
        (\Exception $e) {
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
        $data=[
            'category_name'=>'required|string',
        ];
        $row=category::findOrFail($request->cat_id);
        $validated=$request->validate($data);
        category::create([
        'category_name'=>$request->category_name,
        ]);
        return redirect()->route('category.index');}
        catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {

    category::findOrFail($request->cat_id)->delete();
    return redirect()->route('category.index');
    }
}
