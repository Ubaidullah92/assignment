<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';

    public function student()
    {
        return $this->hasOne('App\Student');
    }
}
