<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remotodisco extends Model
{
    use HasFactory;
    protected $fillable = [
      'cve_storageremoto',
      'cve_servidor',
      'remotodisco',
      'pmontaje',
      'cve_udremota',
      'cve_dformato',
      'capacidad',
      'usado',
      'usadop',
      'comontaje',
      'descripcion',
    ];

}
