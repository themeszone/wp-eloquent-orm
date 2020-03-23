<?php

namespace XS\ORM\Database;

use Illuminate\Database\ConnectionResolverInterface;

class Resolver implements ConnectionResolverInterface {

	/**
	 * The default connection name.
	 *
	 * @var string
	 */
	protected $default;


	/**
	 * Get a database connection instance.
	 *
	 *
	 * @param null $name
	 *
	 * @return bool|Database
	 */
	public function connection($name = null) {

		return Database::instance();
	}


	/**
	 * Get the default connection name.
	 *
	 * @return string
	 */
	public function getDefaultConnection() {

		return $this->default;
	}


	/**
	 * Set the default connection name.
	 *
	 * @param  string $name
	 *
	 * @return void
	 */
	public function setDefaultConnection($name) {
		$this->default = $name;
	}
}