<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'date_start', 'date_end', 'name', 'how_many_days', 'total_book', 'total_payment', 'status'];

    public function books()
    {
        return $this->hasMany(Book::class, 'transaction_id');
    }
}
