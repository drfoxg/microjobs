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
        Schema::create('employer_has_workers', function (Blueprint $table) {
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('worker_id');

            $table->foreign('employer_id', 'employer_id_fk')->references('id')->on('users');
            $table->foreign('worker_id', 'worker_id_fk')->references('id')->on('users');

            $table->primary(['employer_id', 'worker_id']);

            $table->index(['employer_id'], 'employer_id_idx');
            $table->index(['worker_id'], 'worker_id_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_has_workers');
    }
};
