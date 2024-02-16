<?php

namespace App\Models\Dbam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bmanual extends Model
{
    use HasFactory;
    protected $table = 'bmanuales';
    protected $fillable = [
        'fecha',
        'cve_esquema',
        'cve_estadobackup',
        'archivos',
        'observaciones',
      ];

      public function esquemas(): BelongsToMany
      {
          return $this->belongsToMany(Esquema::class);
      }
}
