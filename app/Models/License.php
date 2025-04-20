<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'version',
        'expiry_date',
        'purchase_date',
        'license_type',
        'quantity',
        'date_purchase',
        'serial_no',
        'vendor',
        'license_type',
        'Permanent',
        'Renewable',
        'product_key',
        'vendor',
        'status', ['Valid', 'Expired'],
    ];
}
