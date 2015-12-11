<?php

class Question extends Illuminate\Database\Eloquent\Model {

  // MASS ASSIGNMENT -------------------------------------------------------
  protected $fillable = array('text', 'set_id', 'reference');
  protected $hidden = array('created_at', 'updated_at');

  public function set() {
    return $this->belongsTo('Set');
  }

  public function answers() {
    return $this->hasMany('Answer');
  }

}
