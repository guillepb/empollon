<?php

class Nucleus extends Illuminate\Database\Eloquent\Model {

	// MASS ASSIGNMENT -------------------------------------------------------
	protected $fillable = array('name', 'facility', 'is_valid');
	protected $hidden = array('created_at', 'updated_at');

	protected $table = 'nuclei';

	public function sets() {
		return $this->hasMany('Set');
	}

	public function scopeValid($query) {
//		return $query->whereRaw('is_valid = 1');
		return $query->whereIsValid('1');
	}

}
