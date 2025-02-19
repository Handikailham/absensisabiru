<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Posisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.tampil') }}" class="text-gray-800 hover:text-blue-600">Data Karyawan</a>
                <a href="{{ route('absen.admin.index') }}" class="text-gray-800 hover:text-blue-600">Data Absensi</a>
                <a href="{{ route('posisi.index') }}" class="text-blue-600 font-bold">Data Posisi</a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 max-w-3xl mx-auto">
            <div class="p-6">
                <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Edit Posisi</h1>

                <!-- Alert Sukses -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Alert Error -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('posisi.update', $posisi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama Posisi -->
                    <div class="space-y-2">
                        <label for="nama_posisi" class="block text-sm font-medium text-gray-700">Nama Posisi</label>
                        <input type="text" id="nama_posisi" name="nama_posisi" value="{{ old('nama_posisi', $posisi->nama_posisi) }}" required 
                            class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Input Gaji Pokok -->
                    <div class="space-y-2 mt-4">
                        <label for="gaji_pokok" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                        <input type="number" step="0.01" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok', $posisi->gaji_pokok) }}" required 
                            class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Input Tunjangan -->
                    <div class="space-y-2 mt-4">
                        <label for="tunjangan" class="block text-sm font-medium text-gray-700">Tunjangan</label>
                        <input type="number" step="0.01" id="tunjangan" name="tunjangan" value="{{ old('tunjangan', $posisi->tunjangan) }}" required 
                            class="w-full py-2 px-4 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('posisi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 shadow-md">
                            Kembali
                        </a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
