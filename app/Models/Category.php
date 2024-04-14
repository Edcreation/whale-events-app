<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'displayName',
        'description'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
