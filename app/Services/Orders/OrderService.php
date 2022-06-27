<?php

namespace App\Services\Orders;

use App\Interfaces\Orderable;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Exception;

class OrderService implements Orderable
{
    /**
     * @inheritDoc
     */
    public function calculateOrder(Order $order, array $productsQuantity): array
    {
        $productIds = [];

        foreach ($productsQuantity as $productId => $quantity) {
            $productIds[] = $productId;
        }

        $validSuppliers = Supplier::get();
        $validProducts = Product::whereIn('id', $productIds)
            ->get();

        $this->validateOrder($validSuppliers, $validProducts);

        return (new SupplierChooser($validProducts, $validSuppliers, $productsQuantity))->handle();
    }

    /**
     * Validates the order.
     *
     * @param [type] $validSuppliers
     * @param [type] $validProducts
     * @return void
     */
    protected function validateOrder($validSuppliers, $validProducts): void
    {
        if (is_null($validSuppliers)) {
            throw new Exception('There are no suppliers for this order.');
        }

        if (is_null($validProducts)) {
            throw new Exception('There are no products for this order.');
        }
    }
}
