<?php
/**
 * When we get / visit the home page '/'
 * Expect the response to be 200.
 */
it('returns a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
