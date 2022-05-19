<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Artist extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function artistCategory()
    {
        return $this->belongsTo(ArtistCategory::class);
    }

}
