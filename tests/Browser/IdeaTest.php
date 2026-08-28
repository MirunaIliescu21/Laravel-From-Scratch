<?php

use App\Models\User;

it('shows all ideas', function () {
    // Given I'm signed in and I have one idea in the db.
    // When I visit /ideas, I should see my one idea

    // Create a user using the corresponding factory.
    $this->actingAs($user = User::factory()->create());

    // Manually create his own idea (or if we have a factory to create an idea).
    $user->ideas()->create([
        'description' => 'Build a thing.'
        // 'state' attribute is set in the Idea Model !! otherwise it fails
    ]);

    // When I visit idea, I expect to see the idea.
    visit('/ideas')
        ->assertSee('Build a thing.');
});


it('shows a single idea', function () {
    // We log in, create an idea, visit the specific page
    $this->actingAs($user = User::factory()->create());

    $idea = $user->ideas()->create([
        'description' => 'Build a thing.'
    ]);

    visit("/ideas/{$idea->id}")
        ->assertSee('Build a thing.');
});

it('shows an edit form to update an idea', function () {
    $this->actingAs($user = User::factory()->create());

    $idea = $user->ideas()->create([
        'description' => 'Build a thing.'
    ]);

    visit("/ideas/{$idea->id}/edit")
        ->assertSee('Build a thing.');
});

/**
 * Unhappy paths:
 * Visit the /ideas page without being logged.
 */
it('redirects guests to login page', function () {
    $this->visit("/ideas")
        ->assertPathIs('/login'); //ruta de redirect
});


/**
 * Trying to edit an idea that isn't yours.
 * we need 2 users: owner and the current instance user !
 */
it('prevents a user from editing another user`s idea', function () {
    // We create a user and his idea.
    $owner = User::factory()->create();
    $idea = $owner->ideas()->create([
        'description' => 'Not yours'
    ]);

    // Now we try to edit this idea by another user.
    $this->actingAs($user = User::factory()->create());
    visit("/ideas/{$idea->id}/edit")
        ->assertSee('403'); // we receive unauthorized access
});

/**
 * Trying to create an idea with an empty description.
 */
it ('fails to create an idea with an empty description', function () {
    // This line simulates that the user is created and signed in.
    $this->actingAs($user = User::factory()->create());

    // As we are already signed in, it means that we can create an idea.
    $this->visit('/ideas/create')
        ->fill('description', '')
        ->press('Save')
        ->assertSee('Description is required.'); // receive the error message for empty description

    // Also check the DB - the new idea isn't created.
    expect($user->ideas()->count())->toBe(0);
});


/**
 * AN IMPORTANT OBSERVATION
 * expect($user->ideas()->count())->toBe(0); vs expect($user->ideas->count())->toBe(0);
 *
 * `$user->ideas()` — apelezi metoda relației, care returnează un obiect `HasMany` (query builder).
 * Apoi `->count()` rulează o interogare SQL nouă, proaspătă, de tip `SELECT COUNT(*) FROM ideas WHERE user_id = ?`.
 * Ia mereu valoarea actuală din baza de date, indiferent de ce s-a întâmplat înainte în memorie.
 *
 * `$user->ideas` — accesezi relația ca **proprietate magică** (dynamic property), definită prin `__get()` în Eloquent.
 * Asta declanșează **lazy loading**: dacă relația nu a fost încărcată încă, Laravel o încarcă o dată și
 * o **stochează în cache** pe obiectul `$user` (în `$user->relations`).
 * De atunci înainte, `$user->ideas` returnează acea colecție deja încărcată din memorie
 * **nu** mai face un query nou la baza de date, decât dacă forțezi refresh (`$user->load('ideas')` sau `$user->refresh()`).
 *

 * Dacă la momentul creării `$user`-ului (înainte de acțiunea din test) relația `ideas` nu a fost încă accesată deloc, nu contează care variantă o folosești — ambele dau rezultat corect, pentru că e primul acces.
 *
 * *Dar** — dacă undeva mai devreme în test ai fi accesat deja `$user->ideas` (proprietate) *înainte* de a încerca crearea ideii eșuate, acea colecție ar fi fost cache-uită goală în memorie. După aceea, chiar dacă în DB s-ar fi întâmplat ceva (corect sau din greșeală), `$user->ideas->count()` tot ar returna valoarea veche din cache, nu valoarea reală din DB — ceea ce ar putea masca un bug real (de exemplu, dacă validarea nu funcționează corect și ideea chiar se salvează, testul ar trece fals-pozitiv).
 *
 * *Concluzie practică pentru testare:** folosește mereu `$user->ideas()->count()` (cu paranteze) când verifici starea din DB după o acțiune — e garantat corect, pentru că interoghează baza de date direct, fără riscul de cache stale.
 */
