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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->default(0);
            $table->string('name')->nullable();
            $table->text('active_cases')->nullable();
            $table->string('icon')->nullable();
            $table->string('route_name')->nullable();
            $table->string('route_params')->nullable();
            $table->tinyInteger('is_multi_level')->default(0);
            $table->tinyInteger('display_order')->default(0);
            $table->enum('status',['Active','InActive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
