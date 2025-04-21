<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ITAsset extends Model
{
    use HasFactory;
    protected $table = 'it_assets';

    // Relationships
    public function licenses()
    {
        return $this->hasMany(ITAssetLicenseDetail::class, 'it_asset_id');
    }

    public function licenseDetails()
    {
        return $this->hasMany(ITAssetLicenseDetail::class, 'it_asset_id');
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(ITAssetMaintenance::class, 'it_asset_id');
    }
    
    public function assignedUser() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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
        // 'license_id',
        'user_id'
    ];
}