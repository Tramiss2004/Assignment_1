<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITAssetLicenseDetail extends Model
{
    use HasFactory;


    protected $table = 'it_asset_license_details';

    public function user()
    {
        return $this->hasOne(User::class, 'id'); // assuming 'user_id' is the foreign key
    }


    public function license()
    {
        return $this->belongsTo(License::class, 'license_id', 'id');
    }

    public function itAsset()
    {
        return $this->belongsTo(ITAsset::class, 'it_asset_id', 'id');
    }

}

