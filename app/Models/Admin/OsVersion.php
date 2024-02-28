<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsVersion extends Model
{
    use HasFactory;
    protected $fillable = [
        'osversion',
        'cve_distribucion',
    ];
}
