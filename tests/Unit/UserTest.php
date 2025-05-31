<?php

use App\Model\User;

test('Test Users', function () {
    $user = new User('aaaaaaa-ca72-9f99-bb57-xxxxxxxxxxxxx');
    expect($user)
        ->toHaveProperties([
            'id',
            'name',
            'email',
            'password',
        ])
        ->name->toBe('Benny');

    expect(fn() => new User('xxxxxxxxx'))->toThrow(Exception::class);
    expect(fn() => new User(['xxxxxxxxx' => 'xxxx']))->toThrow(Exception::class);
});
