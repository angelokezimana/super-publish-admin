<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function categories()
    {
        return $this->hasMany('App\Models\Categorie', 'category_id');
    }

    public function publications()
    {
        return $this->hasMany('App\Models\Publication', 'category_id');
    }
}
