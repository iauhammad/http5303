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
}
