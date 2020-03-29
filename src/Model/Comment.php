<?php

namespace XS\ORM\Model;


class Comment extends XS_Model {

	protected $primaryKey = 'comment_ID';


	/**
	 *
	 * @since 1.0.0
	 *
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeApproved($query) {
		return $query->where('comment_approved', '1');
	}


	/**
	 * Post relation for a comment
	 *
	 * @since 1.0.0
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function post() {
		return $this->hasOne('XS\ORM\Model\Post');
	}
}