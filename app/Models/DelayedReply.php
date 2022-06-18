<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayedReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'created_by',
        'order_id',
    ];
}
