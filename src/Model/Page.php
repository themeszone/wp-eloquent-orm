<?php

namespace XS\ORM\Model;

use Illuminate\Database\Eloquent\Builder;


/**
 * Class Post
 *
 *
 * @package XS\ORM\Model
 */
class Page extends XS_Model {

	const CREATED_AT = 'post_date';
	const UPDATED_AT = 'post_modified';

	public $table = 'posts';


	/**
	 * Filter by post status
	 *
	 * @param $query
	 * @param string $status
	 *
	 * @return mixed
	 */
	public function scopeStatus($query, $status = 'publish') {
		return $query->where('post_status', '=', $status);
	}


	/**
	 * Filter by post author
	 *
	 * @param $query
	 * @param null $author
	 *
	 * @return mixed
	 */
	public function scopeAuthor($query, $author = null) {
		if($author) {
			return $query->where('post_author', '=', $author);
		}
	}


	public function meta() {
		return $this->hasMany('XS\ORM\Model\PostMeta', 'post_id');
	}


	public function comments() {
		return $this->hasMany('XS\ORM\Model\Comment', 'comment_post_ID');
	}


	protected static function boot() {

		parent::boot();

		static::addGlobalScope('post_type', function(Builder $builder) {
			$builder->where('post_type', '=', 'page');
		});
	}
}