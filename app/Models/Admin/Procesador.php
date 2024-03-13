<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasOne;

class Procesador extends Model
{
    use HasFactory;
    protected $table = 'procesadores';
    protected $fillable = [
        'procesador',
        'nucleos',
        'velocidad',
        'cve_mprocesador',
        'cve_aprocesador',
    ];
    // protected $appends = ['mprocesador','aprocesador'];
    //
    public function mprocesador()
    {
        return $this->hasOne(Mprocesador::class,'id','cve_mprocesador');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');

    }
    //
    // public function getMprocesadorAttribute(){
    //    return $this->mprocesador()->get();
    // }
    public function aprocesador()
    {
        return $this->hasOne(Aprocesador::class,'id','cve_aprocesador');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');

    }
    //
    // public function getAprocesadorAttribute(){
    //    return $this->aprocesador()->get();
    // }
}
