<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function publications()
    {
        return $this->hasMany('App\Models\Publication', 'category_id');
    }
}
