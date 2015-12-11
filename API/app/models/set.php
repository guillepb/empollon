<?php

class Set extends Illuminate\Database\Eloquent\Model {

  // MASS ASSIGNMENT -------------------------------------------------------
  protected $fillable = array('name', 'nucleus_id', 'published');
  protected $hidden = array('created_at', 'updated_at');

  public function nucleus() {
		return $this->belongsTo('Nucleus');
	}

  public function questions() {
    return $this->hasMany('Question');
  }
}
