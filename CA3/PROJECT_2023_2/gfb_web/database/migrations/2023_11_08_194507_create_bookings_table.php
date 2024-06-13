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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('user_id');
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('additional_requirement')->nullable();
            $table->string('reason')->nullable();
            $table->bigInteger('phone_no')->nullable();
            $table->enum('status', ['booked','pending'])->default('pending');
            $table->timestamps();


            $table->foreign('subcategory_id')
            ->references('id')
            ->on('subcategories')
            ->onDelete('cascade');


            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
