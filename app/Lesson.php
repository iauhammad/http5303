<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    public function getStartTime()
    {
        return substr($this->start_time,0,5);
    }
    public function getEndTime()
    {
        return substr($this->end_time, 0, 5);
    }
    public function getLessonFee()
    {
        return "$ $this->fee";
    }

    public function student()
    {
        return $this->hasOne('App\Student', 'id', 'student_id');
    }
    public function subject()
    {
        return $this->hasOne('App\Subject','id', 'subject_id');
    }
}
