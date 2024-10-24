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

            // Foreign key to users table for user_id
            $table->unsignedBigInteger('user_id')->comment('user_id is the reference to users table');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key to student_classes table
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('student_classes')->onDelete('cascade');

            $table->integer('year_id');

            // Field for image
            $table->string('image')->nullable();

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

