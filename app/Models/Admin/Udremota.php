<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Udremota extends Model
{
    use HasFactory;
    protected $fillable = [
        'udremota',
    ];

    //relaciones muchos-muchos
    public function storageremotos(){
      return $this->belongsToMany(Storageremoto::class);
    }

}
