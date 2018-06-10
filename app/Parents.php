<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $table = 'parents';

     /**
     * The students that belong to the parent.
     */
    public function students()
    {
        return $this->belongsToMany('App\Student','student_parent', 'parent_id', 'student_id');
    }
}
