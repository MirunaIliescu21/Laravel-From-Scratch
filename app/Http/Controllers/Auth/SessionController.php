<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the attributes
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::default()],
        ]);

        // Attempt a login and redirect
        if (Auth::attempt($validated)) {
            $request->session()->regenerate(); // to prevent any potential dangerous situations
            return redirect('/ideas')->with('success', 'You are now logged in');
        }

        return back()->withErrors([ // for displaying these error we need to put in our view the error component
                                    // login.blade.php with the name of the error <x-forms.error name="email"/>
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/ideas');
    }
}
