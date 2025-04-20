<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ITAssetLicenseDetail extends Model
{
    use HasFactory;

    public function license()
    {
        return $this->hasOne(License::class, 'license_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id'); // assuming 'user_id' is the foreign key
    }

    public function itAsset()
    {
        return $this->hasOne(ITAsset::class, 'it_asset_id');
    }
    protected $fillable = [
        'it_asset_id',
        'license_id',
    ];
 
    protected $table = 'it_asset_license_details';

    protected $fillable = ['it_asset_id', 'license_id'];
    
    public function license()
    {
        return $this->belongsTo(License::class, 'license_id');
    }

    public function itAsset()
    {
        return $this->belongsTo(ITAsset::class, 'it_asset_id');
    }

}
