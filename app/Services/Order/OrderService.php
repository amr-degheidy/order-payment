<?php

declare(strict_types=1);

namespace App\Services\Order;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final readonly class OrderService implements OrderServiceInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function getUserOrders(array $filters = []): JsonResource
    {
        return OrderResource::collection(
            $this->orderRepository->getAllOrdersByUserIdWithFilters(auth()->id(), $filters)
        );
    }
    /**
     * @param array{name:string, price:float, quantity: int} $data
     */
    public function placeOrder(array $data): Order
    {
       return $this->orderRepository->create($data);
    }
}
