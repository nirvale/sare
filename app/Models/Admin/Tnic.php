<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tnic extends Model
{
    use HasFactory;
    protected $fillable = [
        'tnic',
    ];
    public function nics(): BelongsTo
    {
        return $this->belongsToMany(Nics::class);
    }
}
