<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
   Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id'); 
            $table->integer('quantity');
            $table->decimal('total_price', 8, 2);
            $table->timestamps();

           
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');
        });

    
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
