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
    // protected $alias = [
    // 'distribucion' => 'distribución',
    // ];
    public function os()
    {
        return $this->hasOne(Os::class,'id','cve_os');
        //return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }

}
