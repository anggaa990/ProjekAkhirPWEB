<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nasi Goreng, Burger, dll
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // harga
            $table->integer('stock')->default(0); // stok
            $table->string('image')->nullable(); // path gambar
            $table->boolean('is_available')->default(true); // tersedia/tidak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};