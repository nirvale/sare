<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprocesador extends Model
{
    use HasFactory;
    protected $table = 'aprocesadores';
    protected $fillable = [
        'aprocesador',
    ];
    public function servidores(): BelongsTo
    {
        return $this->belongsToMany(Servidor::class);
    }
}
