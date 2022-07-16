<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Complain extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getComplains(){
        return $this->belongsTo(User::class,'id');
    }
}
