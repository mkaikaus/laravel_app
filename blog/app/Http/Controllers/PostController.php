<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(3);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function edit($id)
    {
        // dd($id);

        $post = Post::where('id', $id)->first();
        $posts = Post::paginate(3);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post = Post::find($id);
        $post->update([
            'body' => $request->input('body')
        ]);

        return redirect()->route('posts')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts')->with('success', 'Post deleted successfully.');
    }
}
