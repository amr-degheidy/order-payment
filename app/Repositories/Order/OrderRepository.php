<?php

declare(strict_types=1);

namespace App\Repositories\Order;

use App\Enums\OrderFilters;
use App\Enums\OrderStatus;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Collection;

final class OrderRepository implements OrderRepositoryInterface
{

    public function getAllOrdersByUserIdWithFilters(int $userId, array $filters = []): Collection
    {

        $orderQuery = Order::whereUserId($userId);
        if(isset($filters[OrderFilters::Status->value])) {
            $orderQuery->whereStatus($filters[OrderFilters::Status->value]);
        }
        if(isset($filters[OrderFilters::Date->value])) {
            $orderQuery->whereDate('created_at',Carbon::createFromFormat('d-m-Y',$filters[OrderFilters::Date->value]));
        }

        return $orderQuery->get();
    }
    /**
     * @param array{name:string, price:float, quantity: int} $data
     */
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function updateOrderStatusById(int $orderId, OrderStatus $orderStatus): void
    {
        Order::find($orderId)->update(['status' => $orderStatus->value]);
    }
}
