<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ideas = Idea::all();

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
    public function store(Request $request)
    {
        /*
        Validation of null input.
        Laravel will handle the process of automatically redirecting back to the form.
         */
        $request->validate([
            'description' => ['required', 'min:10'],
        ]);

        Idea::create([
            'description' => request('description'),
            'state' => 'pending'
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
    public function update(Request $request, Idea $idea)
    {
        $idea->update([
            'description' => request('description')
        ]);
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
