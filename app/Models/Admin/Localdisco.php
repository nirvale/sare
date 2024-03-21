<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localdisco extends Model
{
    use HasFactory;
    protected $fillable = [
      'cve_servidor',
      'disco',
      'pmontaje',
      'cve_dformato',
      'capacidad',
      'usado',
      'usadop',
      'comontaje',
      'descripcion',
    ];


}
