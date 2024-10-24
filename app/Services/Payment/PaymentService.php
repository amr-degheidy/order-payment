<?php

namespace App\Services\Payment;

use App\Contracts\PaymentMethodInterface;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

final readonly class PaymentService implements PaymentServiceInterface
{
    public function __construct(
        private PaymentMethodInterface $paymentMethod,
        private TransactionRepositoryInterface $transactionRepository,
        private OrderRepositoryInterface $orderRepository,
        private LoggerInterface $logger
    ){
    }

    public function payOrder(Order $order): string
    {
        $totalAmount = $order->quantity * $order->price;

        $purchaseData = [
            'amount' => $totalAmount,
            'currency' => 'USD',
            'returnUrl' => route('payment.success'),
            'cancelUrl' => route('payment.cancel'),
        ];

        $response = $this->paymentMethod->purchase($purchaseData);

        if($response->isRedirect()){

            $this->transactionRepository->createFromData([
                'reference' => $response->getTransactionReference(),
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'token' => Request::create($response->getRedirectUrl())->query->get('token'),
            ]);

            return $response->getRedirectUrl();
        }

        $this->logger->error($response->getMessage());

        throw new \Exception('Payment initiation failed: ' . $response->getMessage());

    }

    public function completePayment(array $paymentInfo = []): void
    {
        $response = $this->paymentMethod->complete($paymentInfo);

        if($response->isSuccessful()){

            $transaction =
                $this->transactionRepository
                    ->updateTransactionStatusByReference(
                        $response->getData()['id'],
                        PaymentStatus::Success
                    )
            ;

            $this->orderRepository->updateOrderStatusById($transaction->order_id, OrderStatus::Paid);
            return;
        }

        throw new \Exception('Payment failed: ' . $response->getMessage());
    }

    public function cancelPayment(array $paymentInfo = [])
    {
        $transaction =
            $this->transactionRepository
                ->updateTransactionStatusByToken(
                    $paymentInfo['token'],
                    PaymentStatus::Failed
                )
        ;

        $this->orderRepository->updateOrderStatusById($transaction->order_id, OrderStatus::Canceled);
    }
}
