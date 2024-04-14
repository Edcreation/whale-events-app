<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Event extends Model
{
    use HasFactory;

    protected $keyType = 'string'; // Set the primary key type to string

    public $incrementing = false; // Disable auto-incrementing

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->setAttribute('id', Uuid::uuid4());
            $model->slug = Str::slug($model->name);
        });
    }

    protected $fillable = [
        'name',
        'image',
        'organiser',
        'description',
        'start_date',
        'end_date',
        'slug'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
