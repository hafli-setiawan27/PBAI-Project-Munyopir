<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->unsignedInteger('interval_km')->nullable();
            $table->unsignedSmallInteger('interval_days')->nullable();
            $table->unsignedInteger('last_service_odometer')->nullable();
            $table->date('last_service_date')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();

            $table->index(['vehicle_id', 'expires_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_rules');
    }
};
