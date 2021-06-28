<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required | file',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/blog'))
            {
                mkdir('uploads/blog', 0777, true);
            }

            $image->move('uploads/blog', $imagename);
        }

        else
        {
            $imagename = 'default.png';
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->image = $imagename;
        if ($request->status)
        {
            $blog->status = 'enable';
        } else {
            $blog->status = 'disable';
        }
        $blog->save();

        return redirect('/blogs')->with('successMsg', 'Your Post Has been Successfully Saved !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        //$slug = str_slug($request->name);
        $blog = Blog::findOrFail($id);

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/blog'))
            {
                mkdir('uploads/blog', 0777, true);
            }

            $image->move('uploads/blog', $imagename);
        }

        else
        {
            $imagename = 'default.png';
        }

        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->image = $imagename;
        if ($request->status)
        {
            $blog->status = 'enable';
        } else {
            $blog->status = 'disable';
        }
        $blog->save();

        return redirect('/blogs')->with('successMsg', 'Your Post Has been Successfully Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('/blogs')->with('successMsg', 'Your Post Has been Successfully Deleted !');
    }

    public function unactive_blog($id)
    {
        $unactive_blog = Blog::findOrFail($id);
        $unactive_blog->update(['status' => 'disable']);
        return Redirect::to('/blogs')->with('successMsg', 'Blog Post Un-activated Successfully ):');
    }

    public function active_blog($id)
    {
        $active_blog = Blog::findOrFail($id);
        $active_blog->update(['status' => 'enable']);
        return Redirect::to('/blogs')->with('successMsg', 'Blog Post Activated Successfully ):');
    }

    // public function search($blog_title)
    // {
    //     $search = Blog::where("category_name", "like", "%" . $blog_title . "%")
    //                 ->get();
    //     return $search;
    // }

}

