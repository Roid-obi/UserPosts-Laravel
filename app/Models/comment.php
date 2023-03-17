<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); //satu komentar dimiliki satu user
    }

    public function post()
    {
        return $this->belongsTo(post::class); //satu komentar untuk satu post
    }

    public function replies()
    {
        return $this->hasMany(comment::class, 'parent_id');
    }
    
}
