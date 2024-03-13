<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storageremoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'starageremoto',
        'cve_tecremotadisco',
        'capacidad',
        'usado',
        'disponible',
    ];
}
