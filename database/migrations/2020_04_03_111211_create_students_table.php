<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('school_id');
            $table->string('nis');
            $table->string('name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('student_email');
            $table->string('Father_name');
            $table->string('mother_name');
            $table->string('parent_email');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
