<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wuser extends Model
{
     protected $table = "wuser";
    protected $primaryKey = "user_id";
    public $timestamps = false;
    protected $guarded = [];
}