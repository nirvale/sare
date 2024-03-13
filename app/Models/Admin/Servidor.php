<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasOne;

class Servidor extends Model
{
    use HasFactory;
    protected $table = 'servidores';
    protected $fillable = [
        'fecha',
        'cve_esquema',
        'cve_estadobackup',
        'archivos',
        'observaciones',
    ];
     // protected $appends = ['procesador'];

    public function procesador()
    {
        return $this->hasOne(Procesador::class,'id','cve_procesador');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }

    public function osversion()
    {
        return $this->hasOne(Osversion::class,'id','cve_osversion');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }

    public function nics()
    {
        return $this->hasMany(Nic::class,'cve_servidor','id');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }



    // public function getProcesadorAttribute(){
    //    return $this->procesador()->get();
    // }
    //
    // public function mprocesador()
    // {
    //     return $this->hasOne(Mprocesador::class,'id','cve_mprocesador');
    //     //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    //
    // }
    //
    // public function getMprocesadorAttribute(){
    //    return $this->mprocesador()->get();
    // }

    // public function aprocesador(): HasOne
    // {
    //     return $this->hasOne(Aprocesador::class,'id','cve_aprocesador');
    //     //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    //
    // }


}
