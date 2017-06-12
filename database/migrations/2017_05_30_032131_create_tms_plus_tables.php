<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsPlusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // -- Create tutors table
        // -- -------------------
        if (!Schema::hasTable('tutors')) {
            Schema::create('tutors', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->string('street_address');
                $table->string('city');
                $table->string('province');
                $table->char('postal_code',6);
                $table->char('phone_number',10);
                $table->char('gender',1);
                $table->string('biography');
                $table->timestamps();

                $table->engine = 'InnoDB';
            });
        }


        // -- Create subjects table
        // -- ---------------------
        if (!Schema::hasTable('subjects')) {
            Schema::create('subjects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();

                $table->engine = 'InnoDB';
            });
        }


        // -- Create students table
        // -- ---------------------
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tutor_id')->unsigned();
                $table->string('first_name');
                $table->string('last_name');
                $table->char('gender',1);
                $table->date('date_of_birth');
                $table->integer('grade');
                $table->string('parent_fname');
                $table->string('parent_lname');
                $table->string('parent_phone_number');
                $table->string('parent_email');
                $table->timestamps();

                $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');

                $table->engine = 'InnoDB';
            });
        }


        // -- Create enrollements table
        // -- -------------------------
        if (!Schema::hasTable('enrollments')) {
            Schema::create('enrollments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('student_id')->unsigned();
                $table->integer('subject_id')->unsigned();
                $table->timestamps();
                
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
                
                $table->engine = 'InnoDB';
            });
        }
        

        // -- Create list of subjects table
        // -- -----------------------------
        if (!Schema::hasTable('list_of_subjects')) {
            Schema::create('list_of_subjects', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tutor_id')->unsigned();
                $table->integer('subject_id')->unsigned();
                $table->timestamps();

                $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

                $table->engine = 'InnoDB';
            });
        }

        
        // -- Create lessons table
        // -- --------------------
        if (!Schema::hasTable('lessons')) {
            Schema::create('lessons', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tutor_id')->unsigned();
                $table->integer('student_id')->unsigned();
                $table->integer('subject_id')->unsigned();
                $table->date('lesson_date');
                $table->time('start_time');
                $table->time('end_time');
                $table->decimal('duration');
                $table->enum('status', ['Upcoming', 'Done', 'Cancelled']);
                $table->timestamps();

                $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

                $table->engine = 'InnoDB';
            });
        }
        

        // -- Define subjects
        $subjects = [
            ['name' => 'The Arts'],
            ['name' => 'French as a Second Language: Core'],
            ['name' => 'French as a Second Language: French Immersion'],
            ['name' => 'Health and Physical Education'],
            ['name' => 'Languages'],
            ['name' => 'Mathematics'],
            ['name' => 'Native Languages'],
            ['name' => 'Science and Technology'],
            ['name' => 'Social Studies'],
        ];
        DB::table("subjects")->insert($subjects);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // -- Drop tables
        if (Schema::hasTable('lessons')) {
            Schema::drop('lessons');
        }
        if (Schema::hasTable('list_of_subjects')) {
            Schema::drop('list_of_subjects');
        }
        if (Schema::hasTable('enrollments')) {
            Schema::drop('enrollments');
        }
        if (Schema::hasTable('students')) {
            Schema::drop('students');
        }
        if (Schema::hasTable('tutors')) {
            Schema::drop('tutors');
        }
        if (Schema::hasTable('subjects')) {
            Schema::drop('subjects');
        }
    }
}
