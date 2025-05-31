<?php declare(strict_types=1);
/**
 * This file is to handle The Users Controller
 */

namespace App\Controller;

use App\Model\User;
use Exception;
use SpryPhp\Provider\Db;

/**
 * Users Controller
 */
class Users
{
	/**
	 * Get Users or single User if WHERE has id.
	 *
	 * @param array $columns
	 * @param array $where
	 * @param array $order
	 * @param array $limit
	 *
	 * @return User|User[]|null Single Item or Multiple Items or Null on Failure
	 */
	public static function get(array $columns = ['*'], array $where = [], array $order = [], array $limit = []): User|array|null
	{
		if (!empty($where['id'])) {
            $item = new User($where['id']);
			if ($item) {
				return $item;
			}

			return null;
		}

		$items = [];
		foreach (Db::select(
			table: (new User())->getTable(),
			columns: $columns,
			join: null,
			where: $where,
			group: null,
			order: $order,
			limit: $limit
        ) as $item) {
			$items[] = new User($item);
		}

		return $items;
	}

	/**
	 * Add Users
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $password
	 *
	 * @throws Exception
	 *
	 * @return User|null
	 */
	public static function signup(string $name, string $email, string $password): User
	{
		$user = new User(
			(object) [
				'name' => $name,
				'email' => $email,
				'password' => hash('sha256', $password),
			]
		);

        if (!$user->insert()) {
			throw new Exception("Error Signing Up User");
		}

		return $user;
	}

    /**
	 * Add Users
	 *
	 * @param string $name
	 *
	 * @return User|null
	 */
	public static function add(string $name): ?User
	{
		$item = new User(
			(object) [
				'name' => $name,
			]
		);

        $insert = $item->insert() ? true : null;

		return $insert;
	}

    /**
	 * Delete Single Users by ID
	 *
	 * @param string $id
	 *
	 * @return bool|null
	 */
	public static function delete(string $id): ?bool
	{
        $delete = (new User($id))->delete() ? true : null;

		return $delete;
	}
}
