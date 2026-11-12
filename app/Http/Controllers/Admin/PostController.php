<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan daftar semua berita di admin
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('admin.index', compact('posts'));
    }

    // Menampilkan form untuk membuat berita baru
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    // Menghapus berita
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required',
        'body' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi file gambar maksimal 2MB
    ]);

    $imagePath = null;

    // Cek apakah admin mengunggah file gambar
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('post-images', 'public');
    }

    Post::create([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'body' => $request->body,
        'image' => $imagePath, // Simpan path gambar ke database
    ]);

    return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil ditambahkan dengan gambar!');
}

// Menampilkan form untuk mengedit berita
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.edit', compact('post', 'categories'));
    }

    // Memperbarui data berita di database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $post->image;

        // Cek apakah admin mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui!');
    }
}



