<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile("image")) {
            $imageName = $request->file("image")->getClientOriginalName() . "-" . time() . "." .
                $request->file("image")->getClientOriginalExtension();
            $request->file("image")->move(public_path("images/posts"), $imageName);
        }


        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $imageName
        ]);

        return redirect()->route("posts.index")->with('success', 'Post created successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return view('posts.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        function uploadImage($file)
        {

            $imageName = $file->getClientOriginalName() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/posts'), $imageName);

            return $imageName;
        }
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($request->image != "") {
            // delete old image
            File::delete(public_path('images/posts/' . $post->image));
            $post->update([
                // Update the image if a new one is uploaded
                'image' => $request->hasFile('image') ? uploadImage($request->file('image')) : $post->image,
            ]);
        }
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        // delete image
        File::delete(public_path('images/posts/' . $post->image));

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
