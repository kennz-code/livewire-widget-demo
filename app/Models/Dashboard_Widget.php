<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dashboard_Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'widget_id',
        'user_id'
    ];

    public function userId(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
