<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * OrderProduct model.
 *
 * @package App\Models
 *
 * @property  int $id
 * @property  int $order_id
 * @property  int $product_id
 * @property  int $quantity
 * @property  int $subtotal
 *
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 *
 */
class OrderProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'subtotal',
    ];
}
