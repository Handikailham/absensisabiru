<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.tampil') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('admin.tampil') ? 'font-bold text-blue-600' : '' }}">
                    Data Karyawan
                </a>
                <a href="{{ route('absen.admin.index') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('absen.admin.index') ? 'font-bold text-blue-600' : '' }}">
                    Data Absensi
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Detail Absensi</h1>

        <!-- Card Detail Absensi -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700">Nama Karyawan</label>
                <p class="text-gray-900">{{ $absen->karyawan->nama }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Tanggal</label>
                <p class="text-gray-900">{{ $absen->tanggal }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Jam Masuk</label>
                <p class="text-gray-900">{{ $absen->jam_masuk ?? '-' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Jam Pulang</label>
                <p class="text-gray-900">{{ $absen->jam_pulang ?? '-' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <p class="text-gray-900">{{ ucfirst($absen->status) }}</p>
            </div>
            <a href="{{ route('absen.admin.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Kembali</a>
        </div>
    </div>
</body>
</html>