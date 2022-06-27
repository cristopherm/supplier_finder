<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Customer model.
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
class Customer extends Model
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
}
