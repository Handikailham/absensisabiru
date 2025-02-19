<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Izin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-3xl overflow-hidden border border-blue-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
            <h2 class="text-2xl font-bold">Ajukan Izin</h2>
        </div>

        <!-- Body -->
        <div class="p-6">
            <!-- Notifikasi -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('absen.izin') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="karyawan_id" value="{{ auth()->id() }}">

                <!-- Tanggal Mulai -->
                <div>
                    <label for="izin_mulai" class="block text-gray-700 font-medium">Tanggal Mulai</label>
                    <input type="date" name="izin_mulai" class="w-full p-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required>
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label for="izin_selesai" class="block text-gray-700 font-medium">Tanggal Selesai</label>
                    <input type="date" name="izin_selesai" class="w-full p-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required>
                </div>

                <!-- Alasan -->
                <div>
                    <label for="alasan" class="block text-gray-700 font-medium">Alasan</label>
                    <textarea name="alasan" rows="3" class="w-full p-3 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('absen.index') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                        Ajukan Izin
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
