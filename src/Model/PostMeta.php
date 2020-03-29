<?php

namespace XS\ORM\Model;


/**
 * Class PostMeta
 *
 * Usage example:
 * $pm = PostMeta::where('post_id', 24)->where('meta_key' , 'bla_bla')->get();
 * $pm = PostMeta::post(24)->key('bla_bla')->get();
 * $pm->value -> will give you json decoded meta_value
 * $pm->uns_value -> will give you deserialized meta_value
 *
 *
 * @package XS\ORM\Model
 */
class PostMeta extends XS_Model {

	protected $primaryKey = 'meta_id';
	protected $table = 'postmeta';


	public function getValueAttribute($value) {

		$result = @json_decode($this->meta_value);

		if(json_last_error() === JSON_ERROR_NONE) {

			return $result;
		}

		return $this->meta_value;
	}


	public function getUnsValueAttribute() {

		return empty($this->meta_value) ? '' : @unserialize($this->meta_value);
	}


	/**
	 *
	 * @since 1.0.0
	 *
	 * @param $query
	 * @param string $post_id
	 *
	 * @return mixed
	 */
	public function scopePost($query, $post_id = '') {
		if(!empty($post_id)) {
			return $query->where('post_id', $post_id);
		}
	}


	/**
	 *
	 * @since 1.0.0
	 *
	 * @param $query
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function scopeKey($query, $key = '') {
		if(!empty($key)) {
			return $query->where('meta_key', '=', $key);
		}
	}
}
