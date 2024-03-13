<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nic extends Model
{
    use HasFactory;
    protected $fillable = [
        'nic',
        'cve_servidor',
        'cve_tnic',
        'ip',
        'gateway',
        'netmask',
        'cve_dns1',
        'cve_dns2',
        'cve_dns3',
        'mac',
        'descripcion',
    ];

    public function servidor()
    {
        return $this->belongsTo(Servidor::class,'id','cve_servidor');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');

    }

}
