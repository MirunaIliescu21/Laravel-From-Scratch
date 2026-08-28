<?php

/**
 * When we visit / open the home page '/'
 * We expect to see 'Welcome' on the page.
 *
 * visit('/') is literally opening a browser.
 *
 * debug() to see the opened browser,
 * otherwise we can use --debug in the command line but
 * is too fast to be able to capture the opening browser.
 */

it('returns a successful response', function () {
    visit('/')->assertSee('Welcome')->debug();
});
