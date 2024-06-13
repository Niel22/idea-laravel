<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\Idea;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        
        $ideas = Idea::orderBy('created_at', 'DESC');

        if($request->has('search')){

            $idea = $ideas->where('idea','like','%' . request()->get('search', '') . '%');

        }
        


        return view('dashboard', ['ideas' => $ideas->paginate(5), 'search' => $request ?? '']);
    }

    
}
