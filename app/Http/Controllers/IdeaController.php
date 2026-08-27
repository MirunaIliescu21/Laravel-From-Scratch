<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * This make the same thing as the previous query
         * $ideas = Idea::query()->where([ 'user_id' => Auth::id() ])->get();
         */
        $ideas = Auth::user()->ideas;

        // Pass our $ideas into the view 'ideas/index' => $ideas
        return view('ideas/index', [
            'ideas' => $ideas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Laravel thinks: I need to figure out the corresponding policy for Idea and then call 'create' on it.
        // Gate::authorize('create', Idea::class);

        // Pass our $idea into the view 'ideas/create'
        return view('ideas/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request)
    {
        $idea = Auth::user()->ideas()->create([
            'description' => request('description'),
            'state' => 'pending',
        ]);

        // notify the user
        Auth::user()->notify(new IdeaPublished($idea));

        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        // Let's authorize an update (the policy name) for $idea - it finds dynamically the policy
        Gate::authorize('update', $idea);

        /** ALTERNATIV
         * If the authed user cannot update the idea
                if(Auth::user()->cannot('update', $idea)) {
                    dd('not authorized');
                }
         * */

        return view('ideas/show', [
            'idea' => $idea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        // Let's authorize an update (the policy name) for $idea - it finds dynamically the policy
        Gate::authorize('update', $idea);

        // Pass our $idea into the view 'ideas/edit' => $idea
        return view('ideas/edit', [
            'idea' => $idea
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea)
    {
        // Let's authorize an update (the policy name) for $idea - it finds dynamically the policy
        Gate::authorize('update', $idea);

        $idea->update([
            'description' => $request->description,
        ]);

        // redirect to the show page of the edited idea
        return redirect("/ideas/{$idea->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        // Let's authorize an update (the policy name) for $idea - it finds dynamically the policy
        Gate::authorize('update', $idea);

        $idea->delete();
        return redirect('/ideas');
    }
}
