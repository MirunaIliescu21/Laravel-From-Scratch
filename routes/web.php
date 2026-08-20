<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;

Route::get('/', function () {
    // $ideas = DB::table('ideas')->get();
    // $ideas = Idea::where('state', 'pending')->get();

    $ideas = Idea::query()
        ->when(request('state'), function ($query, $state) {
            // Query where the query state is equal to what is specified within the query
            $query->where('state', $state);
        })
    ->get();

    // Pass our $ideas into the view 'ideas' => $ideas
    return view('ideas', [
        'ideas' => $ideas
    ]);
});

Route::post('/ideas', function () {
    $idea = request('idea');

    Idea::create([
        'description' => $idea,
        'state' => 'pending'
    ]);

    return redirect('/');
});

// Temporary
Route::get('/delete-ideas', function () {
    session()->forget('ideas');
    return redirect('/');
});

Route::view('/about', 'about');
Route::view('/contact', 'contact');
