<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mprocesador extends Model
{
  use HasFactory;
  protected $table = 'mprocesadores';
  protected $fillable = [
      'mprocesador',
  ];
}
