<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\Orders\OrderService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderRepository
{
    public function save(array $productsQuantity, Customer $customer): Order
    {
        $service = new OrderService();

        try {
            return DB::transaction(function () use ($productsQuantity, $customer, $service) {
                $order = new Order([
                    'customer_id' => $customer->id,
                ]);

                $calculatedOrder = $service->calculateOrder($order, $productsQuantity);

                $order->supplier_id = $calculatedOrder['supplier_id'];
                $order->total = $calculatedOrder['total'];
                $order->save();

                foreach ($calculatedOrder['items'] as $item) {
                    $order->setRelation('orderProduct', OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['subtotal'],
                    ]));
                }

                return $order;
            });
        } catch (Throwable $th) {
            Log::error($th);
            throw new Exception(__('general.unknown_error'));
        }
    }
}
