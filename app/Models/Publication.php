<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Categorie');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
