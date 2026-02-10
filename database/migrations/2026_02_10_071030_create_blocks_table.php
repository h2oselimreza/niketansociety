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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('block_code',50)->nullable()->unique();
            $table->string('block_name', 50)->index();
            $table->integer('block_order')->default(1);
            $table->boolean('is_active')->default(1);
            $table->string('created_by', 70);
            $table->string('updated_by', 70);
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
        Schema::dropIfExists('blocks');
    }
};
