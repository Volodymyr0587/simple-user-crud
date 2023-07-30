<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $formFields['title'] = strip_tags($formFields['title']);
        $formFields['body'] = strip_tags($formFields['body']);
        $formFields['user_id'] = auth()->id();

        Post::create($formFields);

        return redirect('/');
    }

    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id === $post->user_id) {
            return view('edit-post', ['post' => $post]);
        }
        return redirect('/');
    }

    public function update(Post $post, Request $request)
    {
        if (auth()->user()->id === $post->user_id) {
            $formFields = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);

            $formFields['title'] = strip_tags($formFields['title']);
            $formFields['body'] = strip_tags($formFields['body']);

            $post->update($formFields);

            return redirect('/');
        }
        return redirect('/');
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id === $post->user_id) {
            $post->delete();
        }
        return redirect('/');
    }

}
