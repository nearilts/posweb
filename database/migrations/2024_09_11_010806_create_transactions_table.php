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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->date('tanggal')->nullable();
            $table->date('tanggal_kirim')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('kasir')->nullable();
            $table->integer('user_id')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->bigInteger('diskon')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('total_profit')->nullable();
            $table->bigInteger('paid')->nullable();
            $table->bigInteger('unpaid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
