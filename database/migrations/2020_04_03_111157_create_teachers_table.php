<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('school_id');
            $table->bigInteger('subject_id')->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('telp1')->nullable();
            $table->string('telp2')->nullable();
            $table->string('email')->unique();
            $table->string('departement')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
