<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="{{ route('admin.tampil') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Data Karyawan</a>
                <a href="{{ route('absen.admin.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Data Absensi</a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">Detail Absensi</h1>
            <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <label class="block text-gray-600 font-medium">Nama Karyawan</label>
                    <p class="text-gray-900 font-semibold">{{ $absen->karyawan->nama }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <label class="block text-gray-600 font-medium">Tanggal</label>
                    <p class="text-gray-900 font-semibold">{{ $absen->tanggal }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <label class="block text-gray-600 font-medium">Jam Masuk</label>
                    <p class="text-gray-900 font-semibold">{{ $absen->jam_masuk ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <label class="block text-gray-600 font-medium">Jam Pulang</label>
                    <p class="text-gray-900 font-semibold">{{ $absen->jam_pulang ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <label class="block text-gray-600 font-medium">Status</label>
                    <p class="text-gray-900 font-semibold">{{ ucfirst($absen->status) }}</p>
                </div>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('absen.admin.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 transition">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
