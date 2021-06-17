<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablero extends Model
{
    use HasFactory;

    protected $fillable=['nombre','userId'] ;
    protected $hidden=['created_at','updated_at'];


    public function usuarioCreador(){
        return $this->belongsTo(User::class,'userId');
    }

}
