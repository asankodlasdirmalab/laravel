<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function edit(Post $post)
    {
        $post->load("user");

        return view('post', compact("post"));
    }

    public function create()
    {
        return view('post_yeni');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Post::create([
            'title' => $validated['title'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard');
    }


    public function update(Request $request, Post $post)
    {

        if (Gate::denies("update-post", $post)) {
            abort("403", "Icazə yoxdur");
        }


        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $post->update($validated);

        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('dashboard');
    }
}
