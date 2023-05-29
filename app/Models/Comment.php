<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = false;
//    protected $fillable = [
//        'user_id',
//        'ticket_id',
//        'content'
//    ];

    public function ticket(): belongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
