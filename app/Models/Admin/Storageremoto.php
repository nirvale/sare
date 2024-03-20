<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storageremoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'storageremoto',
        'cve_tecremotadisco',
        'cve_servidor',
        'cve_mhardware',
        'cve_datacenter',
        'capacidad',
        'usado',
        'usadop',
    ];
    //relaciones muchos-muchos
    public function udremotas(){
      return $this->belongsToMany(Udremota::class);
    }
}
