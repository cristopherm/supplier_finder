<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductPack;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'Test customer',
        ]);

        $suplierA = Supplier::create([
            'name' => 'Supplier A',
        ]);

        $suplierB = Supplier::create([
            'name' => 'Supplier B',
        ]);

        $floss = Product::create([
            'name' => 'Dental Floss',
        ]);

        $ibuprofen = Product::create([
            'name' => 'Ibuprofen',
        ]);


        // Supplier A
        ProductPack::create([
            'product_id' => $floss->id,
            'supplier_id' => $suplierA->id,
            'quantity' => 1,
            'price' => 900,
        ]);

        ProductPack::create([
            'product_id' => $floss->id,
            'supplier_id' => $suplierA->id,
            'quantity' => 20,
            'price' => 16000,
        ]);

        ProductPack::create([
            'product_id' => $ibuprofen->id,
            'supplier_id' => $suplierA->id,
            'quantity' => 1,
            'price' => 500,
        ]);

        ProductPack::create([
            'product_id' => $ibuprofen->id,
            'supplier_id' => $suplierA->id,
            'quantity' => 10,
            'price' => 4800,
        ]);


        // Supplier B
        ProductPack::create([
            'product_id' => $floss->id,
            'supplier_id' => $suplierB->id,
            'quantity' => 1,
            'price' => 800,
        ]);

        ProductPack::create([
            'product_id' => $floss->id,
            'supplier_id' => $suplierB->id,
            'quantity' => 10,
            'price' => 7100,
        ]);

        ProductPack::create([
            'product_id' => $ibuprofen->id,
            'supplier_id' => $suplierB->id,
            'quantity' => 1,
            'price' => 600,
        ]);

        ProductPack::create([
            'product_id' => $ibuprofen->id,
            'supplier_id' => $suplierB->id,
            'quantity' => 5,
            'price' => 2500,
        ]);

        ProductPack::create([
            'product_id' => $ibuprofen->id,
            'supplier_id' => $suplierB->id,
            'quantity' => 100,
            'price' => 41000,
        ]);
    }
}
