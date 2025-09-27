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
            $table->string('name');
            $table->text('description')->nullable(); // الوصف قد يكون فارغاً
            $table->decimal('price', 8, 2); // السعر، يقبل حتى 8 أرقام منها 2 بعد الفاصلة
            $table->string('image'); // سنخزن هنا مسار الصورة فقط
            
            // هذا هو المفتاح الأجنبي لربط المنتج بالفئة
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
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
