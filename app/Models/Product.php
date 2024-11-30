<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    public $timestamps = false;

    protected $table = "products";

    protected $fillable = [
        "name",
        "description",
        "price",
        "image",
        "stock",
        "status",
        "registered_by"
    ];

    protected $guarded = ["id", "status", "registered_by"];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
