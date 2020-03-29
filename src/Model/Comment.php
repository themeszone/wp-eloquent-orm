<?php

namespace WeDevs\ORM\WP;


use XS\ORM\Model\XS_Model;

class Comment extends XS_Model {

	protected $primaryKey = 'comment_ID';


	/**
	 * Post relation for a comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function post() {
		return $this->hasOne('XS\ORM\Model\Post');
	}
}