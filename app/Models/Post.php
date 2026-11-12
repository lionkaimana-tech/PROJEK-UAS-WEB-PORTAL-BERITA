<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Comment; // <-- Tambahkan baris ini di bagian atas

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    // Setiap berita milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke komentar
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}