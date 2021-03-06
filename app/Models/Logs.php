<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this -> belongsTo(User::class,'created_by');
    }
    public function getOrderstatus(){
        return $this->belongsTo(Orders::class,'order_id');
    }

}
