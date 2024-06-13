<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\Comment;
use Dotenv\Exception\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request, Idea $idea){
        try{
            $comment = $request->validated;
            
    
            $comment['idea_id'] = $idea->id;
            $comment['user_id'] = auth()->id();
    
            Comment::create($comment);
    
            return back()->with('success', 'Comment Posted successfully');

        }catch(ValidationException $e){
            return back()->withErrors([
                'comment'
            ])->withInput();
        }
    }
}
