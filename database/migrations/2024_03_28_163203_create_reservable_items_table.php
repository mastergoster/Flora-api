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
        Schema::create('reservable_items', function (Blueprint $table) {
            $table->id();
            // TODO: Verifier nommage des colonnes
            $table->string('name', 255);
            $table->text('description');
            $table->integer('nombre_place')->nullable();
            $table->string('slug', 255);
            $table->unsignedBigInteger('id_images')->nullable();
            $table->foreign('id_images')->references('id')->on('images')->onDelete('SET NULL')->onUpdate('NO ACTION');
            $table->string('color', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservable_items');
    }
};
