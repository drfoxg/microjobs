<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\JobState;
use App\Models\EmployerHasworker;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45)->index()->notnull();
            $table->decimal('cost', 8, 2)->notnull();
            $table->integer('currency_iso')->notnull();
            $table->string('currency_name', 3)->notnull()->default('РУБ');

            $table->foreignIdFor(JobState::class)->index()->constrained()->comment('Внешний ключ на состояния задачи');

            $table->unsignedBigInteger('employer_has_worker_employer_id');
            $table->unsignedBigInteger('employer_has_worker_worker_id')->nullable()->default(null);

            $table->foreign('employer_has_worker_employer_id', 'employer_has_worker_employer_id_fk')->references('employer_id')->on('employer_has_workers');
            $table->foreign('employer_has_worker_worker_id', 'employer_has_worker_worker_id_fk')->references('worker_id')->on('employer_has_workers');

            $table->index(['employer_has_worker_employer_id', 'employer_has_worker_worker_id'], 'employer_has_worker_idx');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
