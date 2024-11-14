<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'idKarya');  // Specify the correct foreign key
    }

    public function votes()
    {
        return $this->hasMany(vote::class, 'idKarya');  // Assuming foreign key is 'idKarya'
    }


}