<?php

namespace App\Models;

use App\Events\OrderUpdatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'queue'
    ];

    protected $dispatchesEvents = [
        'updated' => OrderUpdatedEvent::class
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
