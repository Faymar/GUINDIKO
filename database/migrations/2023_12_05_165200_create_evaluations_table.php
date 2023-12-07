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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('note');
            $table->string('message')->nullable();
            $table->unsignedBigInteger('userMentor_id');
            $table->foreign('userMentor_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('userMentore_id');
            $table->foreign('userMentore_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('estArchive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
