<?php declare(strict_types=1);
/**
 * DB Schema file
 * !!! WARNING: Use SpryPHP's DB Schema File at your own risk.
 * !!! Make sure to backup your database before altering this file and running the Update DB Schema Command.
 * !!! Removing Tables, Columns, Field options, etc will PERMANENTLY DELETE or ALTER THEM from your database.
 * !!! This is a one to one match of the database and does not retain any migrations or backups.
 *
 * Usage: `Db::updateSchema(APP_PATH_DB_SCHEMA_FILE);` or from CLI `php spry update`
 *
 * PRIMARY ID
 *   A primary unique `id` column is automatically created for each Table as a UUID 7 string.
 *
 * TIMESTAMPS
 *   A `created_at` and `updated_at` columns are automatically created for each Table as CURRENT_TIMESTAMP.
 *
 *
 * Custom Column Field Options:
 *
 *     name    (string)       Any Valid SQL Column Identifier
 *                            required
 *
 *     type    (string)       A valid SQL Type. Ex   "VARCHAR(60)" | "TEXT" | "INT(10)" | "ENUM('A','B')" | DATETIME | etc.
 *                            default: "VARCHAR(128)"
 *
 *     default (string|null)  Default value for Column. Either `string` or `null`.
 *                            default: null
 *
 *     null    (bool)         Whether column is nullable.
 *                            default: true
 *
 *     index   (bool|string)  Boolean if Column has Index. "unique" for UNIQUE INDEX.
 *                            default: false
 *
 */

return [
    'users' => [
        [
            'name' => 'name',
        ],
        [
            'name' => 'status',
            'type' => "enum('ACTIVE','INACTIVE')",
            'null' => false,
            'default' => 'ACTIVE',
        ],
        [
            'name' => 'email',
            'index' => 'unique',
        ],
        [
            'name' => 'password',
        ],
    ],
    'sessions' => [
        [
            'name' => 'token',
            'index' => 'unique',
        ],
        [
            'name' => 'user_id',
            'index' => 'unique',
        ],
    ],
];
