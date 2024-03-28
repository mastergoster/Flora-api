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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // TODO: Verifier nommage des colonnes
            $table->string('email', 100)->unique();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('password', 255);
            $table->string('pin', 8);
            $table->string('token', 8);
            $table->string('phone_number', 10)->unique();
            $table->boolean('activate')->default(0);
            $table->boolean('verify')->default(0);
            $table->string('postal_code')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->text('desc')->nullable();
            $table->string('display', 255)->default('0000');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
