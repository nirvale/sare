<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datacenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'datacenter',
        'tipo',
        'desc_datacenter',
    ];
}
