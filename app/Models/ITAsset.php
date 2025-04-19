<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    //To join users.name into the it_assets table
    public static function withUserForAsset($assetId)
    {
        return DB::table('users')
            ->leftJoin('it_assets', 'it_assets.user_id', '=', 'users.id')
            ->select(
                'it_assets.id as asset_id',
                'it_assets.name as asset_name',
                'users.id as user_id',
                'users.name as users_name',
                'it_assets.*'
            )
            ->where('it_assets.id', $assetId)
            ->first(); // returns a single result
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















    
    // public static function withGroupedLicenseIds()
    // {
    //     return DB::table('it_assets')
    //         ->join('it_asset_license_details', 'it_assets.id', '=', 'it_asset_license_details.asset_id')
    //         ->select('it_assets.id as asset_id', 'it_assets.name','it_assets.*', 'it_asset_license_details.*',
    //             DB::raw('GROUP_CONCAT(it_asset_license_details.license_id) as license_ids'))
    //         ->groupBy('it_assets.id', 'it_assets.name')
    //         ->get();
    // }
    //
    // public static function withAssetLicenseDetailsAndUsers()
    // {
    //     return DB::table('it_assets')
    //         ->leftJoin('it_asset_license_details', 'it_assets.id', '=', 'it_asset_license_details.asset_id')
    //         ->leftJoin('users', 'it_assets.user_id', '=', 'users.id')
    //         ->select(
    //             'it_assets.id as asset_id',
    //             'it_assets.name as asset_name',
    //             'it_asset_license_details.id as asset_license_id',
    //             'users.id as user_id',
    //             'users.name as user_name'
    //         )
    //         ->get();
    // }
}