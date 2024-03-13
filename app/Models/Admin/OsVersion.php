<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsVersion extends Model
{
    use HasFactory;
    protected $fillable = [
        'osversion',
        'cve_distribucion',
    ];

    public function distribucion()
    {
        return $this->hasOne(Distribucion::class,'id','cve_distribucion');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }

}
