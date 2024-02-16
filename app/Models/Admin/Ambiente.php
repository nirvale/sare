<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    public function servidores(): BelongsTo
    {
        return $this->belongsToMany(Servidor::class);
    }
}
