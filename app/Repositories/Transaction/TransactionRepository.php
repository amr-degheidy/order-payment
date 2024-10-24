<?php

namespace App\Repositories\Transaction;

use App\Enums\PaymentStatus;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function createFromData(array $data): void
    {
        Transaction::create($data);
    }

    public function updateTransactionStatusByReference(string $transactionReference, PaymentStatus $paymentStatus): Transaction
    {
       $transaction = Transaction::whereReference($transactionReference);

       $transaction->update(['status'=> $paymentStatus->value]);
        return $transaction->first();
    }

    public function updateTransactionStatusByToken(string $token, PaymentStatus $paymentStatus): Transaction
    {
        $transaction = Transaction::whereToken($token);

        $transaction->update(['status'=> $paymentStatus->value]);

        return $transaction->first();
    }
}
