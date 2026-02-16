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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('student_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('file_path');
            $table->integer('score')->nullable();
            $table->timestamps();
                        $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['assignment_id']);
        });
        Schema::dropIfExists('submissions');
    }
};
