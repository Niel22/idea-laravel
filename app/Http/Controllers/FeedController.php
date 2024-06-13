<?php

namespace App\Http\Controllers;

use App\Models\Idea;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {


        $followings = auth()->user()->followings()->pluck('user_id');


        $ideas = Idea::whereIn('user_id', $followings)->orderBy('created_at', 'DESC');

        if($request->has('search')){

            $idea = $ideas->where('idea','like','%' . request()->get('search', '') . '%');

        }

        $pageTitle = 'Feed';

        return view('dashboard', ['ideas' => $ideas->paginate(5), 'search' => $request ?? '', 'pageTitle' => $pageTitle]);
    }
}
