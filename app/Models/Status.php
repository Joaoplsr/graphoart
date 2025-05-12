<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $table = 'status';

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
