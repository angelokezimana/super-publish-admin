<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    public function categories()
    {
        # code...
        return $this->hasMany(Categorie::class,'category_id');
    }
}
