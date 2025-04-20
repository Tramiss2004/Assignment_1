<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITAssetLicenseDetail extends Model
{
    use HasFactory;    
    protected $table = 'it_asset_license_details';
    protected $fillable = ['it_asset_id', 'license_id'];
}
