<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
