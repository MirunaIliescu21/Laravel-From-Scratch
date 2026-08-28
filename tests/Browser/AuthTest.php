<?php
use App\Models\User;

/**
 * press('@register-button') in the layout file for the register page,
 * we use an identifier named data-test="register-button" to specify our button.
 *
 * In this case, we hit the correct button and successfully register a new user.
 * And return to the /ideas page.
 */
it('returns a successful response', function () {
    // When I visit the registration page
    // and I fill out and submit de form.
    // Then I should have an account
    // and I should be signed in.
    // And I should be on the /ideas page.

    visit('/register')
        ->fill('name', 'Miruna Iliescu')
        ->fill('email', 'miruna@ex.com')
        ->fill('password', '12341234')
        ->press('@register-button')
    ->assertPathIs('/ideas');

    // We expect to have a new user in DB
    expect(User::where('email', 'miruna@ex.com')->exists())->toBeTrue();

    $this->assertAuthenticated();
});


/**
 * Unhappy paths
 */
it('fails to register with an invalid email', function() {
    visit('/register')
        ->fill('name', 'Miruna Iliescu')
        ->fill('email', 'not-an-email')
        ->fill('password', '12341234')
        ->press('@register-button')
        ->assertPathIs('/register') ;    // remain on the /register page


    expect(user::where('name', 'Miruna Iliescu')->exists())->toBeFalse();
    $this->assertGuest();
});


it('fails to register with a duplicate email', function () {
    User::factory()->create(['email' => 'miruna@ex.com']);

    visit('/register')
        ->fill('name', 'Miruna Iliescu')
        ->fill('email', 'miruna@ex.com')
        ->fill('password', '12341234')
        ->press('@register-button')
        ->assertPathIs('/register');

    $this->assertGuest();
});
