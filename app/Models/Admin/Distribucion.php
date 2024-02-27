<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
    use HasFactory;
    protected $table = 'distribuciones';
    protected $fillable = [
        'distribucion',
        'cve_os',
    ];
    protected $alias = [
    'distribucion' => 'distribución',
    ];
    public function oss(): BelongsTo
    {
        return $this->belongsToMany(Os::class);
    }
}
