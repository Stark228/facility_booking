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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name')->unique();
            $table->unsignedBigInteger('category_id'); // Foreign key to relate to the categories table
            $table->string('resource')->nullable();
            $table->unsignedBigInteger('subcategorysession_id')->nullable();
            $table->string('image')->nullable(); 
            $table->enum('method', ['auto','matual'])->default('auto');
            $table->enum('ed', ['enable','disable'])->default('enable');
            $table->time('slot');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('subcategorysession_id')
                ->references('id')
                ->on('subcategorysessions')
                ->onDelete('set null'); // Define the desired action on deletion (e.g., cascade)

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
