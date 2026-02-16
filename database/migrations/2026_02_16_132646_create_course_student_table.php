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
        Schema::create('course_student', function (Blueprint $table) {
            $table->foreignId('course_id')->constrained('courses', 'id')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->primary(['course_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_student', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['course_id']);
        });
        Schema::table('course_student', function (Blueprint $table) {
            $table->dropPrimary(['course_id', 'student_id']);
        });
        Schema::dropIfExists('course_student');
    }
};
