<?php

use App\Enums\OrderStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->decimal('price');
            $table->foreignId('user_id')->constrained(table: 'users');
            $table->enum('status',
                    [
                        OrderStatus::Pending->value,
                        OrderStatus::Paid->value,
                        OrderStatus::Canceled->value
                    ]
                )
                ->default(OrderStatus::Pending->value)
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
