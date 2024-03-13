<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dns extends Model
{
    use HasFactory;
    protected $fillable = [
        'dnsname',
        'cve_servidor',
        'dnsip',
    ];
}
