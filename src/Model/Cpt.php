<?php
/**
 * Created by  Md. Atiqur Rahman <atiqur.su@gmail.com>
 *
 * Date: 3/29/2020 - 10:03 PM
 */

namespace XS\ORM\Model;


class Cpt extends XS_Model {

	const CREATED_AT    = 'post_date';
	const UPDATED_AT    = 'post_modified';
	protected $postType = 'post';


	/**
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function getTypeAttribute() {

		return $this->post_type;
	}


	/**
	 *
	 * @since 1.0.0
	 *
	 * @param $value
	 */
	public function setTypeAttribute($value) {
		$this->attributes['post_type'] = trim($value);
	}


	/**
	 * Filter by post type
	 *
	 * @param $query
	 * @param string $type
	 *
	 * @return mixed
	 */
	public function scopeType($query, $type = 'post') {
		return $query->where('post_type', '=', $type);
	}


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


	/**
	 *
	 * @since 1.0.0
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function meta() {
		return $this->hasMany('XS\ORM\Model\PostMeta', 'post_id');
	}


	/**
	 *
	 *
	 * @since 1.0.0
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments() {
		return $this->hasMany('XS\ORM\Model\Comment', 'comment_post_ID');
	}
}