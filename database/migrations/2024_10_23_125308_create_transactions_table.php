<?php

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
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
            $table->string('reference')->unique();
            $table->foreignId('order_id')->constrained(table: 'orders');
            $table
                ->enum('payment_method',[PaymentMethods::Paypal->value,PaymentMethods::Stripe->value])
                ->default(PaymentMethods::Paypal->value)
            ;
            $table->decimal('amount', 10);
            $table->enum('status',[
                PaymentStatus::Success->value,
                PaymentStatus::Failed->value,
                PaymentStatus::Pending->value,
            ])->default(PaymentStatus::Pending->value);
            $table->string('token')->nullable();
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
