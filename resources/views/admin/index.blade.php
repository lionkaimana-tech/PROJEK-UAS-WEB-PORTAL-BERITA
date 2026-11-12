<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <header class="bg-gray-900 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">DASHBOARD ADMIN</h1>
            <nav class="space-x-4">
                <a href="/" class="hover:underline text-sm">Lihat Website</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Kelola Berita</h2>
            <a href="{{ route('admin.posts.create') }}" class="bg-red-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-red-700 transition">+ Tambah Berita Baru</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-xs uppercase font-semibold">
                        <th class="py-3 px-4">Judul Berita</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse ($posts as $post)
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $post->title }}</td>
                            <td class="py-3 px-4">
                                <span class="bg-red-100 text-red-600 text-xs font-semibold px-2.5 py-1 rounded">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-500">{{ $post->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:underline text-xs font-semibold">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-xs font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada berita yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>