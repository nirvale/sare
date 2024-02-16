<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
  use HasFactory;

  protected $fillable = [
      'backup',
      'desc_backup',
  ];
}
