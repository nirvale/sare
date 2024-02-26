<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
  use HasFactory;
  protected $primaryKey ='id';
  public $incrementing = false;
  //EN CASO DE QUE LA LLAVE NO SEA NÚMERICA
  protected $keyType = 'string';
  protected $fillable = [
      'id',
      'dependencia',
  ];
}
