<?php

class Set extends Illuminate\Database\Eloquent\Model {

  // MASS ASSIGNMENT -------------------------------------------------------
  protected $fillable = array('name', 'nucleus_id', 'published', 'is_valid');
  protected $hidden = array('created_at', 'updated_at');

  public function nucleus() {
		return $this->belongsTo('Nucleus');
	}

  public function questions() {
    return $this->hasMany('Question');
  }

	public function scopeValid($query) {
//  		return $query->whereRaw('is_valid = 1');
      return $query->whereIsValid('1');
  	}

}
