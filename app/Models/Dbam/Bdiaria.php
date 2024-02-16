<?php

namespace App\Models\Dbam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bdiaria extends Model
{
  use HasFactory;

  protected $fillable = [
      'fecha',
      'cve_esquema',
      'cve_estadobackup',
      'archivos',
      'observaciones',
  ];
  public function esquemas(): BelongsTo
  {
      return $this->belongsToMany(Esquema::class,'id');
  }
  public function recoveresquematest(): HasOne
  {
      return $this->hasOne(RecoverEsquemaTest::class,'id');
  }
}
