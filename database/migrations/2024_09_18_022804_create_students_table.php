<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('batch_id');
            $table->string('student_id');
            $table->string('discount')->nullable();
            $table->string('note')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('status');
            $table->string('photo')->nullable();
            $table->string('student_name');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('religion');
            $table->string('sms_mobile');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('guardian_mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('sms');
            $table->string('admission_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
