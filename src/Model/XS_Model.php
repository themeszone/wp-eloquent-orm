<?php
/**
 * Created by  Md. Atiqur Rahman <atiqur.su@gmail.com>
 *
 * Date: 3/25/2020 - 4:31 PM
 */

namespace XS\ORM\Model;

use XS\ORM\Database\Model;

class XS_Model extends Model {

	protected $primaryKey = 'ID';
	protected $post_type = null;

	const CREATED_AT = false;
	const UPDATED_AT = false;

}