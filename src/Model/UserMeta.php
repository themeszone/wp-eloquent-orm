<?php

namespace XS\ORM\Model;


class UserMeta extends XS_Model {

	protected $primaryKey = 'umeta_id';
	public $table = 'usermeta';



	public function getValueAttribute($value) {

		$result = @json_decode($this->meta_value);

		if(json_last_error() === JSON_ERROR_NONE) {

			return $result;
		}

		return $this->meta_value;
	}


	public function scopeKey($query, $key = '') {
		if(!empty($key)) {
			return $query->where('meta_key', '=', $key);
		}
	}
}