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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer("quantity");
            $table->decimal("subtotal")->nullable();
            $table->string("registered_by");

            // Product -> OrderDetail
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")
                ->references("id")
                ->on("products");

            // Order -> OrderDetail
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")
                ->references("id")
                ->on("orders");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
