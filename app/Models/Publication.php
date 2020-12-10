<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Categorie', 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File', 'publication_id');
    }
}
