<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use App\Models\Idea;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{

    public function show(Idea $idea){

        $view = true;
        return view('ideas.show', compact('idea', 'view'));
    }

    public function store(CreateIdeaRequest $request){

        try{
            $idea = $request->validated;
    
            $idea['user_id'] = auth()->id();
    
            Idea::create($idea);
    
            return redirect()->route('dashboard')->with('success', "Idea was created successfully");
        }catch(ValidationException $e){
            return back()->withInput();
        }
    }
    
    public function edit(Idea $idea){

        Gate::authorize('update', $idea);

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea){
        Gate::authorize('update', $idea);

        $newIdea = $request->validated;;


        $idea->update($newIdea);

        return redirect()->route('ideas.show', ['idea' => $idea->id])->with('success', "Idea Updated successfully");
    }


    public function destroy(Idea $idea){
        Gate::authorize('delete', $idea);
        
       $idea->delete();

        return redirect()->route('dashboard')->with('success', "Idea deleted Successfully");
    }
}
