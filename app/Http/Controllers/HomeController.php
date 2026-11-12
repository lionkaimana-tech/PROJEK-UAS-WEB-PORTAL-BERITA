<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('comment', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6);

        $categories = Category::all();
        $recentPosts = Post::latest()->take(5)->get();
        // Ambil 5 berita terpopuler berdasarkan jumlah views terbanyak
        $popularPosts = Post::orderBy('views', 'desc')->take(5)->get();

        return view('home', compact('posts', 'search', 'categories', 'recentPosts', 'popularPosts'));
    }

    public function show(Post $post)
    {
        $post->increment('views');
        $post->load(['comments', 'category']);
        $categories = Category::all();
        $recentPosts = Post::latest()->take(5)->get();
        $popularPosts = Post::orderBy('views', 'desc')->take(5)->get();
        return view('show', compact('post', 'categories', 'recentPosts', 'popularPosts'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(6);
        $categories = Category::all();
        $recentPosts = Post::latest()->take(5)->get();
        $popularPosts = Post::orderBy('views', 'desc')->take(5)->get();

        return view('category', compact('category', 'posts', 'categories', 'recentPosts', 'popularPosts'));
    }
}
