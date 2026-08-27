<?php

use App\Models\User;

it('shows all ideas', function () {
    // given I'm signed in
    $this->actingAs($user = User::factory()->create());

    $user->ideas()->create([
        'description' => 'Build a thing.'
    ]);

    visit('/ideas')
        ->assertSee('Build a thing.');

});


it('shows a single idea', function (    ) {
    //
});

it('shows an edit form to update an idea', function () {
    //
});
