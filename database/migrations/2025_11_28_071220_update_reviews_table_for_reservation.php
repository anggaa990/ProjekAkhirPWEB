<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Hapus foreign key dan kolom menu_id yang lama
            $table->dropForeign(['menu_id']);
            $table->dropColumn('menu_id');
            
            // Tambah kolom reservation_id
            $table->unsignedBigInteger('reservation_id')->after('user_id');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            
            // Ubah tipe data rating jadi 1-5
            $table->integer('rating')->change();
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Kembalikan seperti semula
            $table->dropForeign(['reservation_id']);
            $table->dropColumn('reservation_id');
            
            $table->unsignedBigInteger('menu_id')->after('user_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }
};