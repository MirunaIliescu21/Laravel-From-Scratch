<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ideas = Idea::query()->where([
            'user_id' => Auth::id(),
        ])->get();

        /**
         * This make the same thing as the previous query
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
        // Pass our $idea into the view 'ideas/create'
        return view('ideas/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request)
    {
        /*
        Validation of null input.
        Laravel will handle the process of automatically redirecting back to the form.
         */

        // Instead of this, we create an IdeaRequest file that provides all  the rules for validating a request.
//        $request->validate([
//            'description' => ['required', 'min:10'],
//        ]);

        Idea::create([
            'description' => request('description'),
            'state' => 'pending',
            'user_id' =>Auth::id(), // grab the ID of the current authenticated user
                                    // Auth::user() grab the instance of the user !!dif
        ]);

        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('ideas/show', [
            'idea' => $idea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
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
        // redirect to the show page of the edited idea
        return redirect('/ideas/'.$idea->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect('/ideas');
    }
}
