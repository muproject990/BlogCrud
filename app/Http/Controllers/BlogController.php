<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;



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
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:5'],
            'content' => ['required'],
            'image' => ['image'], // Optionally validate image
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('blogs.create')->withInput()->withErrors($validator);
        }

        // Create a new Blog instance
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;

        // Check if there is an authenticated user
        if (auth()->check()) {
            $blog->user_id = auth()->user()->id; // Assign the authenticated user's ID
        } else {
            // Handle case where there is no authenticated user
            // For example, you might redirect to login or handle this error case accordingly
            return redirect()->route('register')->with('error', 'You must be logged in to create a blog post.');
        }

        // Save the blog post
        $blog->save();

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);

            // Save image path to the blog post
            $blog->image = $imageName;
            $blog->save();
        }

        return redirect()->route('blogs.index')->with('success', 'Blog Added Successfully');
    }

    public function edit($id)
    {
        $blogs = Blog::findOrFail($id);
        if (auth()->user()->id !== $blogs->user_id) {
            dd("You Are Not Authorized  User to edit this post");
        }
        return view(
            'blogs.edit',

            [
                'blog' => $blogs
            ]
        );
    }
    public function update($id, Request $request)
    {
        $blog = Blog::findOrFail($id);



        $rules = [
            'title' => ['required', 'min:5'],
            'content' => ['required'],

        ];



        if ($request->image != '') {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('blogs.edit', $blog->id)->withInput()->withErrors($validator);
        }



        $blog->title = $request->title;
        $blog->content = $request->content;

        // Check if there is an authenticated user
        if (auth()->check()) {
            $blog->user_id = auth()->user()->id; // Assign the authenticated user's ID
        } else {

            return redirect()->route('login')->with('error', 'You must be logged in to create a blog post.');
        }

        $blog->save();


        if ($request->image != '') {
            // delete old image

            File::delete(public_path("uploads/blogs" . $blog->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            // save img to blogs directory

            $image->move(public_path('uploads/blogs'), $imageName);



            // Save image in DB
            $blog->image = $imageName;
            $blog->save();
        }





        return redirect()->route('blogs.index')->with('success', 'Blog Updated Sucessfuly');
    }

    public function destroy($id)
{
            $blog = Blog::findOrFail($id);
            
            // Check if the authenticated user is authorized to delete the blog
            if (auth()->user()->id !== $blog->user_id) {
                return response()->json(['message' => 'You are not authorized to delete this post'], 403);
            }

            // Delete the associated image if it exists
            if ($blog->image) {
                File::delete(public_path('uploads/blogs/' . $blog->image));
            }

            // Delete related comments
            $blog->comments()->delete();

            // Delete the blog
            $blog->delete();

            return redirect()->route('blogs.index')->with('success', 'Blog Deleted Successfully');
}

    public function open($id, Request $request)
    {
        try {
            $blog = Blog::findOrFail($id);

            return view('blogs.open', [
                'blog' => $blog
            ]);
        } catch (ModelNotFoundException $e) {
            dd($e);
        }
    }

    public function storeComment(Request $request, $blogId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // $comment->blog_id = $blogId;
        $comment = new Comment();

        $comment->content = $request->content;
        $comment->blog_id = $blogId;
        $comment->user_id = auth()->id();


        $comment->save();
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function showComments($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $comments = $blog->comments()->orderBy('created_at', 'desc')->get();

        return view('blogs.comments', compact('blog', 'comments'));
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Query to fetch blogs based on title search
        $blogs = Blog::where('title', 'like', '%' . $searchTerm . '%')->get();

        return view('blogs.search', compact('blogs'));
    }
}
