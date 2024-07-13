<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->get();
        return view(
            'blogs.list',
            [
                'blogs' => $blogs
            ]
        );


    }
    public function create()
    {
        return view("blogs.create");

    }
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            $rules = [
                'title' => ['required', 'min:5'],
                'content' => ['required'],

            ]

        ]);

        if ($request->image != '') {
            $rules['image'] = 'image';

        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('blogs.create')->withInput()->withErrors($validator);

        }


        $blog = new Blog();

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();


        if ($request->image != '') {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            // save img to blogs directory

            $image->move(public_path('uploads/blogs'), $imageName);



            // Save image in DB
            $blog->image = $imageName;
            $blog->save();
        }





        return redirect()->route('blogs.index')->with('success', 'Blog Added Sucessfuly');







    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function destroy()
    {

    }
}
