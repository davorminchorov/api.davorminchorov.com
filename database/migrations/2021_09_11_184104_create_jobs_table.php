<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'jobs', callback:  function (Blueprint $table) {
            $table->id();
            $table->string(column: 'queue')->index();
            $table->longText(column: 'payload');
            $table->unsignedTinyInteger(column: 'attempts');
            $table->unsignedInteger(column: 'reserved_at')->nullable();
            $table->unsignedInteger(column: 'available_at');
            $table->unsignedInteger(column: 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'jobs');
    }
}
