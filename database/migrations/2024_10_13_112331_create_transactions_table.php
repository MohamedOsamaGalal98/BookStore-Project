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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name');
            $table->string('user_email');

            $table->Integer('InvoiceId');
            $table->string('InvoiceStatus');
            $table->string('InvoiceReference');
            $table->Integer('InvoiceValue');

            $table->string('TransactionDate');
            $table->string('PaymentGateway');
            $table->string('ReferenceId');
            $table->string('TrackId');
            $table->string('TransactionId');
            $table->string('PaymentId');
            $table->string('AuthorizationId');
            $table->string('TransactionStatus');
            $table->string('TransationValue');
            $table->string('PaidCurrency');
            $table->string('IpAddress');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
