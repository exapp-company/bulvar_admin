<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Requests\Admin\StoreUpdatePaymentMethodRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentMethodController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        return PaymentMethodResource::collection(
            PaymentMethod::query()->latest()->paginate(5)
        );
    }


    public function store(StoreUpdatePaymentMethodRequest $request): JsonResponse
    {
        PaymentMethod::query()->create($request->validated());
        return $this->success('Способ оплаты успешно создан');

    }


    public function update(StoreUpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->update($request->validated());
        return $this->success('Способ оплаты успешно обновлен');

    }


    public function destroy(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->delete();
        return $this->success('Способ оплаты успешно удален');
    }
}
