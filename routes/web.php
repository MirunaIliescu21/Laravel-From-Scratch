<?php

use Illuminate\Support\Facades\Route;
use App\Models\Idea;


// index action
Route::get('/ideas', function () {

    $ideas = Idea::all();

    /**  // Eloquent - elocvent queries
    $ideas = Idea::query()
        ->when(request('state'), function ($query, $state) {
            // Query where the query state is equal to what is specified within the query
            $query->where('state', $state);
        })
    ->get();
     */

    // Pass our $ideas into the view 'ideas/index' => $ideas
    return view('ideas/index', [
        'ideas' => $ideas
    ]);
});


// show action
Route::get('/ideas/{idea}', function (Idea $idea) {

    // Pass our $idea into the view 'ideas/show' => $idea
    return view('ideas/show', [
        'idea' => $idea
    ]);
});

// edit action
Route::get('/ideas/{idea}/edit', function (Idea $idea) {
    // Pass our $idea into the view 'ideas/edit' => $idea
    return view('ideas/edit', [
        'idea' => $idea
    ]);
});

// update action
Route::patch('/ideas/{idea}', function (Idea $idea) {
    $idea->update([
        'description' => request('description')
    ]);

    // redirect to the show page of the edited idea
    return redirect('/ideas/'.$idea->id);
});


// store action
Route::post('/ideas', function () {
    Idea::create([
        'description' => request('description'),
        'state' => 'pending'
    ]);

    return redirect('/ideas');
});

// destroy action
Route::delete('/ideas/{idea}', function (Idea $idea) {
    $idea->delete();

    return redirect('/ideas');
});

Route::view('/about', 'about');
Route::view('/contact', 'contact');
