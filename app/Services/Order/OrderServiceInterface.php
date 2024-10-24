<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

interface OrderServiceInterface
{
    public function getUserOrders(array $filters= []): JsonResource;

    /**
     * @param array{name:string, price:float, quantity: int} $data
     */
    public function placeOrder(array $data): Order;
}
