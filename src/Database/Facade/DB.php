<?php

namespace XS\ORM\Database\Facades;

use Illuminate\Support\Facades\Facade;
use XS\ORM\Database\Database;

/**
 * @see \Illuminate\Database\DatabaseManager
 * @see \Illuminate\Database\Connection
 */
class DB extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return Database::instance();
	}
}