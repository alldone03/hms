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
        Schema::create('state_relays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('Auto')->default(false);
            $table->boolean('relay_1')->default(false);
            $table->boolean('relay_2')->default(false);
            $table->boolean('relay_3')->default(false);
            $table->boolean('relay_4')->default(false);
            $table->boolean('relay_5')->default(false);
            $table->boolean('relay_6')->default(false);
            $table->boolean('relaystate_1')->default(false);
            $table->boolean('relaystate_2')->default(false);
            $table->boolean('relaystate_3')->default(false);
            $table->boolean('relaystate_4')->default(false);
            $table->boolean('relaystate_5')->default(false);
            $table->boolean('relaystate_6')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_relays');
    }
};
