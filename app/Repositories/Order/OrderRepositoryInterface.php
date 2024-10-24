<?php

namespace App\Repositories\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function getAllOrdersByUserIdWithFilters(int $userId, array $filters = []): Collection;
    /**
     * @param array{name:string, price:float, quantity: int} $data
     */
    public function create(array $data): Order;

    public function updateOrderStatusById(int $orderId, OrderStatus $orderStatus): void;
}
