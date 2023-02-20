<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title','created_by','image','content'];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'content' => '',
        'image' => '',
    ];


    public function scopeFilter($query, array $filters)
    {
        // User Search //
        $query->when($filters['user'] ?? false, fn($query, $user) =>
            $query->whereHas('user', fn($query)=>
                $query->where('username', $user)
            )
        );
    }


    public function users()
    {
        return $this->hasMany(User::class, 'created_by');
    }
}
