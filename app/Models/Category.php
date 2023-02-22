<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nama',
        'created_by',
        'description'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'description' => ''
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
