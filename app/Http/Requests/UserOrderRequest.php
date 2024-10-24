<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class UserOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $orderStatuses = array_column(OrderStatus::cases(), 'value');

        return [
            'date'=> ['date','date_format:d-m-Y','before_or_equal:today'],
            'status'=> ["in:" . implode(',', $orderStatuses)],
        ];
    }
}
