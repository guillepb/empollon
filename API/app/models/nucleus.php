<?php

class Nucleus extends Illuminate\Database\Eloquent\Model {

	// MASS ASSIGNMENT -------------------------------------------------------
	protected $fillable = array('name', 'facility');
	protected $hidden = array('created_at', 'updated_at');

	protected $table = 'nuclei';

	public function sets() {
		return $this->hasMany('Set');
	}

}
