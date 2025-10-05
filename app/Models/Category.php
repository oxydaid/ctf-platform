<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image', // Tambahkan ini
        'is_active', // Tambahkan ini
    ];

    protected $casts = [
        'is_active' => 'boolean', // Tambahkan ini
    ];

    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class);
    }
}
