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
            'body' => "required"
        ]);

        $formFields['title'] = strip_tags($formFields['title']);
        $formFields['body'] = strip_tags($formFields['body']);
        $formFields['user_id'] = auth()->id();

        Post::create($formFields);

        return redirect('/');
    }
}
