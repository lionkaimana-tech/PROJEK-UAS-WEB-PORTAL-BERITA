<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">LOGIN ADMIN</h1>
            <p class="text-sm text-gray-500">Masuk untuk mengelola portal berita</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan username">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" required class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded text-sm font-semibold hover:bg-red-700 transition">Masuk</button>
        </form>

        <div class="text-center mt-4">
            <a href="/" class="text-xs text-gray-500 hover:underline">&larr; Kembali ke Beranda Website</a>
        </div>
    </div>

</body>
</html>
