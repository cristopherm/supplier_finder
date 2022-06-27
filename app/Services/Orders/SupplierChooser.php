<?php

namespace App\Services\Orders;

use App\Models\Product;
use App\Models\ProductPack;
use App\Models\Supplier;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SupplierChooser
{
    protected $products;
    protected $suppliers;
    protected array $productsQuantity;

    protected Product $product;
    protected Supplier $supplier;
    protected int $quantity;
    protected int $subTotal;

    /**
     * Undocumented function
     *
     * @param [type] $products
     * @param [type] $suppliers
     * @param array $productsQuantity
     */
    public function __construct($products, $suppliers, array $productsQuantity) {
        $this->products = $products;
        $this->suppliers = $suppliers;
        $this->productsQuantity = $productsQuantity;
    }

    /**
     * Handles the method.
     *
     * @return array
     */
    public function handle(): array
    {
        $totalByProduct = [];

        foreach ($this->suppliers as $supplier) {
            foreach ($this->products as $product) {
                if (!isset($totalByProduct[$product->id][$supplier->id])) {
                    $totalByProduct[$product->id][$supplier->id] = 0;
                }

                $totalByProduct[$product->id][$supplier->id] += $this->prepareSum(
                    $product,
                    $supplier, (int) $this->productsQuantity[$product->id]
                );
            }
        }

        $bestSupllier = $this->findBestSupplier($totalByProduct);
        $total = 0;
        $items = [];

        foreach ($totalByProduct as $productId => $totals) {
            $total += $totals[$bestSupllier];
            $items[] = [
                'product_id' => $productId,
                'quantity' => $this->productsQuantity[$productId],
                'subtotal' => $totals[$bestSupllier],
            ];
        }

        return [
            'supplier_id' => $bestSupllier,
            'total' => $total,
            'items' => $items,
        ];
    }

    /**
     * Handles the method.
     *
     * @return int
     */
    protected function prepareSum(Product $product, Supplier $supplier, int $quantity): int
    {
        $this->subTotal = 0;

        $packs = ProductPack::query()
            ->where('product_id', $product->id)
            ->where('supplier_id', $supplier->id)
            ->orderBy('quantity', 'desc')
            ->get();

        $this->sumProductTotal($packs, $quantity);

        return $this->subTotal;
    }

    /**
     * Calculate the total of the product
     *
     * @param Collection $packs
     * @return mixed
     */
    protected function sumProductTotal($packs, int $quantity)
    {
        foreach ($packs as $pack) {
            if (($quantity / $pack->quantity) >= 1) {
                $quantity = $quantity - $pack->quantity;
                $this->subTotal += $pack->price;
                break;
            }
        }

        if ($quantity == 0) {
            return;
        }

        if ($quantity < 0) {
            throw new Exception('Quantity cannot be negative.');
        }

        return self::sumProductTotal($packs, $quantity);
    }

    protected function findBestSupplier(array $totalByProduct): int
    {
        $totalBySupplier = [];

        foreach ($totalByProduct as $productId => $supplierTotals) {
            foreach ($supplierTotals as $supplierId => $result) {
                if (!isset($totalBySupplier[$supplierId])) {
                    $totalBySupplier[$supplierId] = 0;
                }

                $totalBySupplier[$supplierId] += $result;
            }
        }

        foreach ($totalBySupplier as $supplierId => $result) {
            if (!isset($bestSupplier)) {
                $bestSupplier = $supplierId;
                $bestResult = $result;
            }

            if ($result < $bestResult) {
                $bestSupplier = $supplierId;
                $bestResult = $result;
            }
        }

        return $bestSupplier;
    }
}
