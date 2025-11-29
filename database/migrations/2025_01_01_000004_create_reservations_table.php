<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->date('date');
            $table->time('time');
            $table->unsignedInteger('people')->default(1);
            $table->enum('status',['pending','confirmed','completed','cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('table_id')->references('id')->on('restaurant_tables')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
