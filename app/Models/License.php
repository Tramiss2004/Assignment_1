<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $table = 'licenses';

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
        'product_key',
        'status',
    ];
    

    public function itAssets()
{
    return $this->hasMany(ITAssetLicenseDetail::class, 'license_id');
}
}
