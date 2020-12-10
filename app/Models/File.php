<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function publication()
    {
        return $this->belongsTo('App\Models\Publication', 'publication_id');
    }
}
