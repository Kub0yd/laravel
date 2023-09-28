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
        Schema::create('bad_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_id');
            $table->string('ip');
            $table->timestamps();

            $table->foreign('sub_id')->references('id')->on('subs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bad_transactions');
    }
};
