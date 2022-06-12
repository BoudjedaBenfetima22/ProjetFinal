<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'prix','localisation','categorie','nombre_des_chambres','nombre_des_salles_de_bain'
        ,'nombre_des_cuisines','type_doffre','agence_id','wilaya'
    ];
//    public function category()
//    {
//        return $this->belongsTo(Category::class);
//    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
