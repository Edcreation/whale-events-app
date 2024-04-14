<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Assuming 'id' is the primary key
    protected $keyType = 'string'; // Assuming 'id' is of type uuid
    public $incrementing = false; // Assuming 'id' is not auto-incrementing

    protected $fillable = [
        'id',
        'event_id',
        'name',
        'price',
        'available',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
