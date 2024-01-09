<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createCommemt(Request $request, Post $post)
    {
        $formFields = $request->validate([
            'body' => 'required'
        ]);

        $formFields['body'] = strip_tags($formFields['body']);
        $formFields['user_id'] = auth()->user()->id;
        $formFields['post_id'] = $post->id;

        Comment::create($formFields);

        return back();
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
