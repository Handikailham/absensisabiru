<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
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