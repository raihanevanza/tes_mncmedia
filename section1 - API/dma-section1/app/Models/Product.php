<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product_schema';
    protected $fillable = [
        'item_name', 'quantity', 'totalcostofgoods_sold', 'totalprice_sold'
    ];
}
