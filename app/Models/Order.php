<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Order model.
 *
 * @package App\Models
 *
 * @property  int $id
 * @property  int $customer_id
 * @property  int $supplier_id
 * @property  int $total
 *
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 *
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
    ];

    /**
     * The attachments that belong to the bundle.
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
    }
}
