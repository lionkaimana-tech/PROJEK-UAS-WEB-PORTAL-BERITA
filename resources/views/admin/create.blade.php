<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <header class="bg-gray-900 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">DASHBOARD ADMIN</h1>
            <nav class="space-x-4">
                <a href="{{ route('admin.posts.index') }}" class="hover:underline text-sm">&larr; Kembali ke Daftar Berita</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Form Tambah Berita Baru</h2>

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Judul Berita</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan judul berita...">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Kategori Rubrik</label>
                    <select name="category_id" required class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Isi Berita</label>
                    <textarea name="body" rows="6" required class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Tulis isi berita lengkap di sini...">{{ old('body') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Gambar Utama Berita (Opsional)</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, WEBP (Maks. 2MB)</p>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.posts.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm font-semibold hover:bg-gray-400">Batal</a>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-red-700">Simpan Berita</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>