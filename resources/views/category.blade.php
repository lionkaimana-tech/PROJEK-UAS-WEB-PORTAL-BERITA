<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrik: {{ $category->name }} - Portal Berita Nusantara</title>
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

        <!-- Judul Rubrik -->
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 border-l-4 border-red-600 pl-3">
                Rubrik Kategori: "{{ $category->name }}"
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Daftar Berita Berdasarkan Kategori (Lebar 2 Grid) -->
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($posts as $post)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition flex flex-col justify-between">
                            <div>
                                <span class="inline-block bg-red-100 text-red-600 text-xs font-semibold px-2.5 py-1 rounded m-4 mb-0">
                                    {{ $category->name }}
                                </span>
                                
                                @if ($post->image)
                                    <div class="h-40 overflow-hidden my-3 mx-4 rounded">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                    </div>
                                @endif

                                <div class="px-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-red-600">
                                        <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="text-gray-500 text-xs mb-2">Dipublikasikan: {{ $post->created_at->format('d M Y') }}</p>
                                    <p class="text-gray-700 text-sm mb-4">
                                        {{ Str::limit($post->body, 90) }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <a href="{{ route('post.show', $post->slug) }}" class="text-red-600 font-semibold text-sm hover:underline">Baca Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 bg-white p-8 rounded-lg shadow text-center">
                            <p class="text-gray-500 text-sm italic">Belum ada berita yang tersedia dalam rubrik ini.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Tombol Pagination -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Kolom Kanan: Sidebar Widget (Lebar 1 Grid) -->
            <aside class="space-y-6">
                <!-- Kolom Kanan: Sidebar Widget (Lebar 1 Grid) -->
            <aside class="space-y-6">

                <!-- Widget Berita Terkini -->
                <div class="bg-white p-6 rounded-lg shadow-md border">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Berita Terkini</h3>
                    <div class="space-y-4">
                        @foreach ($recentPosts as $recent)
                            <div class="flex gap-3 items-start">
                                @if ($recent->image)
                                    <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}" class="w-16 h-16 object-cover rounded flex-shrink-0">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center text-gray-400 text-xs">No Image</div>
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

                <!-- 🌟 TAMBAHKAN WIDGET BERITA TERPOPULER DI SINI -->
                <div class="bg-white p-6 rounded-lg shadow-md border">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2 flex items-center gap-2">
                        🔥 Berita Terpopuler
                    </h3>
                    <div class="space-y-4">
                        @foreach ($popularPosts as $index => $popular)
                            <div class="flex gap-3 items-start">
                                <!-- Nomor Peringkat -->
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
            </aside>
                <!-- Widget Kategori Rubrik -->
                <div class="bg-white p-6 rounded-lg shadow-md border">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Rubrik Kategori</h3>
                    <ul class="space-y-2">
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('category.show', $cat->slug) }}" class="flex justify-between items-center text-sm {{ $cat->id == $category->id ? 'text-red-600 font-bold' : 'text-gray-700' }} hover:text-red-600 py-1 border-b border-gray-100 transition">
                                    <span>{{ $cat->name }}</span>
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full">{{ $cat->posts()->count() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
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