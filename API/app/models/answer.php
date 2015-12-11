<?php

class Answer extends Illuminate\Database\Eloquent\Model {

  // MASS ASSIGNMENT -------------------------------------------------------
  protected $fillable = array('text', 'question_id', 'correct');
  protected $hidden = array('created_at', 'updated_at');

  public function question() {
    return $this->belongsTo('Question');
  }

}
