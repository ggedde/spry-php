<?php

use SpryPhp\Provider\Session;

test('Admin Logout', function () {

    $user = Session::getUser();
    expect($user->id)->toBe(0);
    expect($user->name)->toBe('Admin');
    expect($user->type)->toBe('admin');
    expect($user->email)->toBe(APP_ADMIN_EMAIL);
    expect(Session::logoutUser())->toBe(true);
    expect(Session::isUserLoggedIn())->toBe(false);
    expect($_SESSION)->toBe([]);
});
