<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $categories=category::all();
        $rows=post::with('category')->get();
        return view('blogs.blog',compact('rows','categories'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // dd($request);
           try{
            $request->validate([
                'title'=>'required',
                'Description'=>'required',
                'smallDes'=>'required',
                'image'=>'required|image|mimes:jpg'  ]);
            if($request->hasFile('image'))
            {
           $file=$request->file('image');
           $fileName=time().'_'.$file->getClientOriginalName();
           $file->move(public_path('images'), $fileName);
           $blog=new post([
           'title'=>$request->title,
           'Description'=>$request->Description,
           'smallDes'=>$request->smallDes,
           'image'=>$fileName,
           'cat_id'=>$request->id,
           ]);
            }
       $blog->save();
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


    public function update(Request $request)
    {
        try{
            $request->validate([
                'title'=>'required',
                'Description'=>'required',
                'smallDes'=>'required',
                'image'=>'required|image|mimes:jpg'  ]);
            if($request->hasFile('image'))
            {
           $file=$request->file('image');
           $fileName=time().'_'.$file->getClientOriginalName();
           $file->move(public_path('images'), $fileName);
           $blog=new post([
           'title'=>$request->title,
           'Description'=>$request->Description,
           'smallDes'=>$request->smallDes,
           'image'=>$fileName,
           'cat_id'=>$request->id,
           ]);

            }
            $blog->update();

       return redirect()->route('blog.index')->with('status', 'Blog updated Successfully');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('Error', 'Error in updating blog please Try again');
    }
    }


    public function destroy(Request $request)
    {

    post::findOrFail($request->id)->delete();
    return redirect()->route('blog.index');
    }
}
