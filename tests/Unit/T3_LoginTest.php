<?php

use App\View\Dashboard\Admin;
use App\View\Layout\AdminLayout;
use SpryPhp\Provider\Session;

test('Login', function () {

    expect(APP_ADMIN_EMAIL)->toBe('a');
    expect(APP_ADMIN_PASSWORD)->toBe('a');

    // Login User
    Session::loginUser((object) [
        'id' => 0,
        'type' => 'admin',
        'name' => 'Admin',
        'email' => APP_ADMIN_EMAIL,
    ]);

    $user = Session::getUser();

    expect($user->id)->toBe(0);
    expect($user->name)->toBe('Admin');
    expect($user->type)->toBe('admin');
    expect($user->email)->toBe(APP_ADMIN_EMAIL);

    ob_start();
    new AdminLayout(new Admin());
    $contents = ob_get_contents();
    ob_end_clean();

    expect($contents)->toContain('Hello Admin');
});
