<?php declare(strict_types=1);
/**
 * This file is to handle The User Class
 */

namespace App\Model;

use SpryPhp\Model\DbItem;

/**
 * User Instance
 */
class User extends DbItem
{
	/**
	 * User Name
	 *
	 * @var string $name
	 */
	public string $name = '';

	/**
	 * User Email
	 *
	 * @var string $email
	 */
	public string $email = '';

	/**
	 * User Password
	 *
	 * @var string $password
	 */
	protected string $password = '';

    /**
	 * Database Table
	 *
	 * @var string $dbTable
	 */
	protected string $dbTable = 'users';

	/**
     * Construct the User
     * Either pass data as object or UUID.
     *
     * @param object|array<string,mixed>string|null $obj - Data Object or UUID as string or Null for empty Item.
     */
    public function __construct(object|array|string|null $obj = null)
    {
        parent::__construct($obj);
    }
}
