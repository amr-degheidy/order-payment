<?php

namespace App\Repositories\Transaction;

use App\Enums\PaymentStatus;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function createFromData(array $data): void;

    public function updateTransactionStatusByReference(string $transactionReference, PaymentStatus $paymentStatus): Transaction;
    public function updateTransactionStatusByToken(string $token, PaymentStatus $paymentStatus): Transaction;
}
