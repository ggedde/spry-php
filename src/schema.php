<?php declare(strict_types=1);
/**
 * DB Schema file
 */

return [
    'users' => [
        [
            'name' => 'name',
            'type' => 'VARCHAR(120)',
            'null' => true,
            'default' => null,
            'index' => 'unique',
        ],
        [
            'name' => 'status',
            'type' => "enum('ACTIVE','INACTIVE')",
            'null' => false,
            'default' => 'active',
            'index' => false,
        ],
        [
            'name' => 'email',
            'type' => 'VARCHAR(120)',
            'null' => true,
            'default' => null,
            'index' => 'unique',
        ],
        [
            'name' => 'password',
            'type' => 'VARCHAR(120)',
            'null' => true,
            'default' => null,
            'index' => false,
        ],
    ],
    'sessions' => [
        [
            'name' => 'token',
            'type' => 'VARCHAR(120)',
            'null' => false,
            'default' => '',
            'index' => 'unique',
        ],
        [
            'name' => 'user_id',
            'type' => 'VARCHAR(120)',
            'null' => false,
            'default' => '',
            'index' => 'unique',
        ],
    ],
];
