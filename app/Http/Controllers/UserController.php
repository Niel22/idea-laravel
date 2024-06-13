<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(3);

        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        Gate::authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Gate::authorize('update', $user);

        try{
            $data = $request->validated;

            
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('profile', 'public');
                $data['image'] = $imagePath;

                Storage::disk('public')->delete($user->image ?? '');
            }
            

    
            $user->update($data);
    
            return redirect()->route('profile')->with('success', 'Account updated successfully');
        }catch(ValidationException $e){
            return back()->withInput();
        }
    }

    public function profile(){
        return $this->show(auth()->user());
    }

}
