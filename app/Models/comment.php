<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'content'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    
}
