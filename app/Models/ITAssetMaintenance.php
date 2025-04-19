<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITAssetMaintenance extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'it_asset_maintenances';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'description',
        'it_asset_id',
        'status',
        'maintenance_cost',
        'start_date',
        'end_date',
        'maintenance_type',
        'created_at',
        'updated_at',
    ];

    public function asset()
    {
        return $this->belongsTo(ITAsset::class, 'it_asset_id');
    }
}
