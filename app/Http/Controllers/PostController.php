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
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $this->uploadImage($image);
                $images[] = $imageName;
            }
        }
        // dd($images);
        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "images" => json_encode($images)
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
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
        // $oldImages = json_decode($post->images, true) ?? [];

        // foreach ($oldImages as $oldImage) {
        //     $path = public_path('images/posts/' . $oldImage);
        //     if (file_exists($path)) {
        //         unlink($path);
        //     }
        // }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $this->uploadImage($image);
                $images[] = $imageName;
            }
        } else {
            $images[] = $post->images;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'images' => json_encode($images),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $images = json_decode($post->images, true) ?? [];
        foreach ($images as $image) {
            $path = public_path('images/posts/' . $image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    private function uploadImage($file)
    {
        $imageName = $file->getClientOriginalName() . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/posts'), $imageName);

        return $imageName;
    }
}
