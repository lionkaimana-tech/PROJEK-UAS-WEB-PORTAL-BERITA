<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Portal Berita Nusantara</title>
    <!-- Menggunakan CDN Tailwind CSS agar langsung rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Header / Navbar -->
    <header class="bg-red-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wider">
                <a href="/">PORTAL BERITA</a>
            </h1>
            <nav class="space-x-4 flex items-center">
                <a href="/" class="hover:underline">Beranda</a>
                <span class="text-red-300">|</span>
                <span class="text-sm bg-red-700 px-3 py-1 rounded">Laravel 11</span>
            </nav>
        </div>
    </header>

    <!-- Konten Utama dengan Layout 2 Kolom -->
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom Kiri: Detail Artikel Berita (Lebar 2 Grid) -->
            <div class="lg:col-span-2">
                <article class="bg-white rounded-lg shadow-md p-6 lg:p-8">
                    
                    <!-- Kategori, Tanggal, & Jumlah Pembaca -->
                    <div class="flex items-center space-x-2 mb-4">
                        <a href="{{ route('category.show', $post->category->slug) }}"
                            class="bg-red-100 text-red-600 text-xs font-semibold px-2.5 py-1 rounded hover:bg-red-200 transition">
                            {{ $post->category->name }}
                        </a>
                        <span class="text-gray-400 text-xs">•</span>
                        <span class="text-gray-500 text-xs">Dipublikasikan pada: {{ $post->created_at->format('d M Y') }}</span>
                        <span class="text-gray-400 text-xs">•</span>
                        <span class="text-gray-500 text-xs flex items-center gap-1">
                            👁️ {{ $post->views }} kali dibaca
                        </span>
                    </div>

                    <!-- Judul Berita -->
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h2>

                    <!-- Tombol Berbagi Media Sosial -->
                    <div class="mt-4 mb-6 pt-4 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                        <span class="text-sm font-semibold text-gray-700">Bagikan artikel ini:</span>
                        <div class="flex items-center space-x-2">
                            <!-- Tombol WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . route('post.show', $post->slug)) }}" 
                               target="_blank" 
                               class="bg-green-600 text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-1.5">
                                💬 WhatsApp
                            </a>

                            <!-- Tombol Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('post.show', $post->slug)) }}" 
                               target="_blank" 
                               class="bg-blue-600 text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-1.5">
                                📘 Facebook
                            </a>

                            <!-- Tombol Salin Tautan -->
                            <button onclick="navigator.clipboard.writeText('{{ route('post.show', $post->slug) }}'); alert('Tautan berita berhasil disalin!');" 
                                    class="bg-gray-700 text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-gray-800 transition flex items-center gap-1.5">
                                🔗 Salin Link
                            </button>
                        </div>
                    </div>

                    <!-- Gambar Utama Berita -->
                    @if ($post->image)
                        <div class="mb-6 rounded-lg overflow-hidden shadow">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-auto max-h-96 object-cover">
                        </div>
                    @endif

                    <!-- Isi Berita -->
                    <div class="text-gray-700 text-base leading-relaxed space-y-4 mb-8 whitespace-pre-line">
                        {{ $post->body }}
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="pt-6 border-t border-gray-200">
                        <a href="/"
                            class="inline-flex items-center text-sm font-semibold text-red-600 hover:underline">
                            &larr; Kembali ke Beranda
                        </a>
                    </div>
                </article>

                <!-- Bagian Komentar Pembaca -->
                <section class="mt-8 bg-white rounded-lg shadow-md p-6 lg:p-8 border">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Komentar Pembaca</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-sm mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Kirim Komentar -->
                    <form action="{{ route('comments.store', $post->id) }}" method="POST"
                        class="mb-8 bg-gray-50 p-4 rounded-lg border">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-1">Nama Anda</label>
                            <input type="text" name="name" required
                                class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Tulis nama Anda...">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-semibold mb-1">Komentar</label>
                            <textarea name="comment" rows="3" required
                                class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Tulis tanggapan atau komentar Anda..."></textarea>
                        </div>
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-red-700 transition">Kirim Komentar</button>
                    </form>

                    <!-- Daftar Komentar -->
                    <div class="space-y-4">
                        @forelse ($post->comments as $comment)
                            <div class="bg-gray-50 p-4 rounded-lg border flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-1 gap-2">
                                        <h4 class="font-bold text-gray-800 text-sm">{{ $comment->name }}</h4>
                                        <span class="text-xs text-gray-400">• {{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->comment }}</p>
                                </div>

                                <!-- Tombol Hapus Komentar (Muncul untuk Admin/User yang login) -->
                                @auth
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold px-2 py-1 rounded bg-red-50 hover:bg-red-100 transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm italic">Belum ada komentar pada berita ini. Jadilah yang pertama berkomentar!</p>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Kolom Kanan: Sidebar Widget -->
            <aside class="space-y-6">
                <!-- Widget Kategori Rubrik -->
                <div class="bg-white p-6 rounded-lg shadow-md border">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Rubrik Kategori</h3>
                    <ul class="space-y-2">
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('category.show', $cat->slug) }}" class="flex justify-between items-center text-sm text-gray-700 hover:text-red-600 py-1 border-b border-gray-100 transition">
                                    <span>{{ $cat->name }}</span>
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full">{{ $cat->posts()->count() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Widget Berita Terpopuler -->
                <div class="bg-white p-6 rounded-lg shadow-md border">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2 flex items-center gap-2">
                        🔥 Berita Terpopuler
                    </h3>
                    <div class="space-y-4">
                        @foreach ($popularPosts as $index => $popular)
                            <div class="flex gap-3 items-start">
                                <span class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 font-bold text-xs rounded-full flex items-center justify-center">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-800 hover:text-red-600 leading-snug mb-1">
                                        <a href="{{ route('post.show', $popular->slug) }}">{{ Str::limit($popular->title, 42) }}</a>
                                    </h4>
                                    <span class="text-[10px] text-gray-400">👁️ {{ $popular->views }} pembaca</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Widget Berita Terkini -->
                <div class="bg-white p-6 rounded-lg shadow-md border">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Berita Terkini</h3>
                    <div class="space-y-4">
                        @foreach ($recentPosts as $recent)
                            <div class="flex gap-3 items-start">
                                @if ($recent->image)
                                    <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}"
                                        class="w-16 h-16 object-cover rounded flex-shrink-0">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center text-gray-400 text-xs">
                                        No Image</div>
                                @endif
                                <div>
                                    <h4 class="text-xs font-bold text-gray-800 hover:text-red-600 leading-snug mb-1">
                                        <a href="{{ route('post.show', $recent->slug) }}">{{ Str::limit($recent->title, 45) }}</a>
                                    </h4>
                                    <span class="text-[10px] text-gray-400">{{ $recent->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p class="text-sm">&copy; 2026 Portal Berita. Dibangun dengan Laravel & Laragon.</p>
    </footer>

</body>

</html>