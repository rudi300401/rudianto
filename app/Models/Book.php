<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function Catalog ()
    // public function Publisher ()
    // public function Author ()
    {
      
        return $this->belongsTo('App\Models\Catalog', 'Catalog_id');
        // return $this->belongsTo('App\Models\Author', 'author_id');
        // return $this->belongsTo('App\Models\Publisher', 'publisher_id');
    }
}
