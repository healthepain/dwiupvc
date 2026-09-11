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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');

            $table->foreignId('type_id')->constrained('product_types')->onDelete('cascade');

            $table->foreignId('model_id')->constrained('product_models')->onDelete('cascade');

            $table->foreignId('material_id')->constrained('product_materials')->onDelete('cascade');

            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->onDelete('cascade');

            $table->string('product_name', 255);

            $table->decimal('lebar_kusen', 8, 2)->default(0);
            $table->integer('jumlah_lebar_kusen');

            $table->decimal('tinggi_kusen', 8, 2)->default(0);
            $table->integer('jumlah_tinggi_kusen');

            $table->decimal('lebar_daun', 8, 2)->default(0);
            $table->integer('jumlah_lebar_daun');

            $table->decimal('tinggi_daun', 8, 2)->default(0);
            $table->integer('jumlah_tinggi_daun');

            $table->integer('harga_kusen')->nullable();
            $table->integer('harga_daun')->nullable();
            $table->integer('harga_kaca')->nullable();
            $table->integer('harga_panel')->nullable();
            $table->integer('harga_aksesoris')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
