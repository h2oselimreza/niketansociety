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
        Schema::create('block_roads', function (Blueprint $table) {
            $table->id();
            $table->string('block', 100);
            $table->string('road', 100);
            $table->integer('status');
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->timestamp('created_dt_tm')->useCurrent();
            $table->timestamp('updated_dt_tm')
                ->useCurrent()
                ->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_roads');
    }
};
