<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        "date",
        "total",
        "route",
        "status",
        "registered_by",
        "client_id"
    ];

    protected $guarded = ["id", "status", "registered_by"];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
