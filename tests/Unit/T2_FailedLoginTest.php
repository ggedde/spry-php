<?php

use App\Model\User;
use SpryPhp\Provider\Session;

test('Login', function () {

    try {
        // Get User
        $user = new User(['email' => 'a', 'password' => 'a']);
        // Login User
        Session::loginUser((object) [
            'id' => $user->id,
            'type' => 'user',
            'name' => $user->name,
            'email' => $user->email,
        ]);
    } catch (\Exception $e) {
        Session::addAlert('error', 'Incorrect Email or Password');
    }

    expect(Session::getAlerts())->not->toBe([]);

    Session::delete('__ALERTS__');

    expect($_SESSION)->toBe([]);
});
