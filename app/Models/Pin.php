<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    protected $fillable=['titulo','foto','url','tableroId','usuarioCreador'] ;
    protected $hidden=['created_at','updated_at'];


    public function usuarioCreadorPin(){
        return $this->belongsTo(User::class,'usuarioCreador');
    }
    public function tableroPertenece(){
        return $this->belongsTo(Tablero::class,'tableroId');
    }
    public function scopeTitulo($query,$titulo){
        if($titulo){
            return $query->where('titulo','LIKE', "%titulo%");
        }
    }

}
