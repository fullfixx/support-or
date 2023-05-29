<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function tickets(): hasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
