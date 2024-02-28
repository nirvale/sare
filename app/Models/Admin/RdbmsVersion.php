<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RdbmsVersion extends Model
{
    use HasFactory;
    protected $fillable = [
        'rdbmsversion',
        'cve_rdbms',
    ];
}
