<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITAsset extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'it_assets';

    // If you have relationships, define them here
    public function licenses()
    {
        return $this->hasMany(ITAssetLicenseDetail::class, 'it_asset_id');
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(ITAssetMaintenance::class, 'it_asset_id');
    }

    public $timestamps = false;

    protected $fillable = [
        'name',
        'assigned_status',
        'category',
        'brand',
        'model',
        'operating_system',
        'date_purchase',
        'serial_no',
        'status',
        'warranty_available',
        'warranty_due_date',
        'license_available',
        'license_id',
        'user_id'
    ];
}
