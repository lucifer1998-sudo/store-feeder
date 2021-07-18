<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = ['id','data'];
    protected $appends = ['body'];
    public $timestamps = false;

    public function getBodyAttribute(){
        return json_decode($this->data,true);
    }
}
