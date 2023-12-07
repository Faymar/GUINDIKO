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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('contenu');
            $table->string('fichier')->nullable();
            $table->unsignedBigInteger('userEnv_id');
            $table->foreign('userEnv_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('userRec_id');
            $table->foreign('userRec_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('estArchive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
