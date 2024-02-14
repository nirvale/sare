<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
  use HasFactory;
  protected $primaryKey ='cve_oficina';
  public $incrementing = false;
  //EN CASO DE QUE LA LLAVE NO SEA NÚMERICA
//  protected $keyType = 'string';
  protected $fillable = [
      'cve_oficina',
      'oficina',
  ];
}
