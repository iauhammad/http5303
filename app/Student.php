<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public function getFirstName() {
        return $this->first_name;
    }
    public function getLastName() {
        return $this->last_name;
    }
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function lessons()
    {
        return $this->belongsToMany('App\Lesson', 'student_id');
    }
}
