<?php
use App\Models\User;

it('returns a successful response', function () {
    // when I visit the registration page
    visit('/register')
    ->fill('name', 'Miruna Iliescu')
    ->fill('email', 'miruna@ex.com')
    ->fill('password', '12341234')
        ->press('@register-button')
    ->assertPathIs('/ideas');

    // and I fill out and submit de form
    // Then I should have an account
//    expect(User::count())->toBe(1);
    expect(User::where('email', 'miruna@ex.com')->exists())->toBeTrue();
    // And I should be on the /ideas page
    $this->assertAuthenticated();

});
