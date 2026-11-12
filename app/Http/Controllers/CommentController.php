<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // 1. Validasi input nama dan komentar
        $request->validate([
            'name'    => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        // 2. Simpan ke database dengan mengambil data dari input form
        Comment::create([
            'post_id' => $postId,
            'name'    => $request->name,
            'comment' => $request->comment,
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(Comment $comment)
    {
        // Hapus komentar dari database
        $comment->delete();

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}