<?php

namespace App\Models\Dbam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
  use HasFactory;
  protected $fillable = [
      'base',
      'rdbms',
      'version',
      'os',
      'os_version',
      'datacenter',
  ];
}
