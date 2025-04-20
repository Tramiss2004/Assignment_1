<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $table = 'licenses';

    public function licenseDetails()
{
    return $this->hasMany(ITAssetLicenseDetail::class, 'license_id');
}

public function itAssets()
{
    return $this->belongsToMany(ITAsset::class, 'it_asset_license_details', 'license_id', 'it_asset_id');
}

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
    
}
