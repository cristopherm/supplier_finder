<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ProductPack model.
 *
 * @package App\Models
 *
 * @property  int $id
 * @property  int $product_id
 * @property  int $supplier_id
 * @property  int $quantity
 * @property  int $price
 *
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 *
 */
class ProductPack extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'price',
    ];
}
