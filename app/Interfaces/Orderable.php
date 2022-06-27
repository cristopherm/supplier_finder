<?php

namespace App\Interfaces;

use App\Models\Order;

interface Orderable
{
    /**
     * Calculates the customer order.
     *
     * @param Order $order
     * @param array $productsQuantity
     * @return array
     */
    public function calculateOrder(Order $order, array $productsQuantity): array;
}
