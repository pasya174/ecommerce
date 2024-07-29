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
        Schema::create('transactions_olds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->integer('province');
            $table->integer('city');
            $table->integer('kecamatan');
            $table->integer('kelurahan');
            $table->longText('address');
            $table->longText('postal_code');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->integer('points_earned')->default(0)->nullable();
            $table->integer('points_used')->default(0)->nullable();
            $table->integer('temp_points_used')->default(0)->nullable();
            $table->string('status')->default(0);
            $table->string('proof_of_payment')->nullable();
            $table->boolean('payment_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_olds');
    }
};
