<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITAsset extends Model
{
    use HasFactory;
    protected $table = 'it_assets';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'assigned_status',
        'category',
        'brand',
        'model',
        'operating_system',
        'status',
    ];
}
