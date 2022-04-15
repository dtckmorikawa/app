<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docs extends Model
{
    protected $fillable = ['docname', 'user_id', 'created_at', 'updated_at'];

}
