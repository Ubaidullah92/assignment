<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   
    /**
     * Get the student's class.
     */
    public function class()
    {
        return $this->belongsTo('App\Classes');
    }

     /**
     * The parents that belong to the student.
     */
    public function parents()
    {
        return $this->belongsToMany('App\Parents', 'student_parent', 'student_id', 'parent_id');
    }
}
