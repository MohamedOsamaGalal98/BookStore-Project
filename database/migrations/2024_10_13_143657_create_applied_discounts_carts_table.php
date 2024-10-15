<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'name_of_table';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('applied_discounts_carts', function (Blueprint $table) {
            $table->id();

            //user data
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name');
            $table->string('user_email');

            //transaction data
            $table->string('PaymentId');

            //general cart discount data 
            $table->json('general_cart_discount')->nullable();

            //cart books with specific discount for each book
            $table->json('books_data_with_specific_cart_discount')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_discounts_carts');
    }
};
