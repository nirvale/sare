<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mhardware extends Model
{
  use HasFactory;
  protected $table = 'mhardwares';
  protected $fillable = [
      'mhardware',
  ];
}
