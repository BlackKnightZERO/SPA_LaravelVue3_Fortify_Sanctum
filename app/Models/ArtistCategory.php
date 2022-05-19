<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
