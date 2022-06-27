<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product model.
 *
 * @package App\Models
 *
 * @property  int $id
 * @property  string $name
 *
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 *
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The profiles that belong to the bundle.
     */
    public function packs()
    {
        return $this->hasMany(ProductPack::class, 'product_id');
    }

}
