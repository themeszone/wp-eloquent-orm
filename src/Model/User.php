<?php

namespace XS\ORM\Model;


class User extends XS_Model {

	/**
	 *
	 * @since 1.0.0
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function meta() {
		return $this->hasMany('XS\ORM\Model\UserMeta', 'user_id');
	}

	public function posts() {
		return $this->hasMany('XS\ORM\Model\Post', 'post_author');
	}
}