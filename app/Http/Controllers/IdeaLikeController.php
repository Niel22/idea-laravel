<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea){
        $liker = auth()->user();

        $liker->likes()->attach($idea);

        return redirect()->back()->with('success', 'Liked Successfully');
    }

    public function unlike(Idea $idea){
        $liker = auth()->user();

        $liker->likes()->detach($idea);

        return redirect()->back()->with('success', 'Unliked Successfully');
    }
}
