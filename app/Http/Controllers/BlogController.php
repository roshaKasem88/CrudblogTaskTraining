<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $rows=post::with('category')->latest()->paginate(10);
        return view('blogs.blog',compact('rows'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {try{
        $data=[
            'title'=>'required|string',
            'smallDes'=>'required',
            'Description'=>'required',
            'image'=>'image|jpg,png,jpeg',
            'cat_id' => 'required|exists:App\Models\category,id'

        ];
        $validated=$request->validate($data);
        post::create([
            'title'=>$request->title,
            'Description'=>$request->Description,
            'smallDes'=>$request->Description,
            'image'=>$request->image,
            'cat_id' => $request->cat_id,

        ]);
        return redirect()->route('blog.index')->with('status', 'Blog Created Successfully');;
    }


        catch(\Exception $e) {
            return redirect()->back()->with('Error', 'Error in Creating blog please Try again');

    }

    }


    public function show(blog $blog)
    {
        //
    }


    public function edit(blog $blog)
    {
        //
    }


    public function update(Request $request,post $post)
    {
        try{
            $request->validate([
                'title'=>'required|string',
                'smallDes'=>'required',
                'Description'=>'required',
                'image'=>'image|jpg,png,jpeg',
                'cat_id' => 'required|exists:App\Models\category,id'

            ]);
            $post->title=$request->title;
            $post->Description=$request->Description;
            $post->smallDesc=$request->smallDesc;
            $post->Image=$request->Image;
            $post->category_id = $request->category_id;
            $post->save();
            return redirect()->route('blog.index');
        }


            catch(\Exception $e) {
                return redirect()->back()->with('Error', 'Error in Creating blog please Try again');

        }
    }


    public function destroy(Request $request)
    {

    $row=post::findOrFail($request->id)->delete();
    return redirect()->route('blog.index',compact('row'));
    }
}
