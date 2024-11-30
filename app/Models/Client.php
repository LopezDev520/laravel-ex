<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    use HasFactory;

    public $timestamps = false;

    protected $table = "clients";

    protected $fillable = [
        "name",
        "document",
        "address",
        "phone",
        "email",
        "photo",
        "status",
        "registered_by"
    ];

    protected $guarded = ["id", "status", "registered_by"];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
