<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Tambah Absensi</h1>

        <!-- Form Tambah Absensi -->
        <form action="{{ route('absen.admin.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="karyawan_id" class="block text-gray-700">Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="w-full px-4 py-2 border rounded-lg" required>
                    @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="jam_masuk" class="block text-gray-700">Jam Masuk</label>
                <input type="time" name="jam_masuk" id="jam_masuk" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="jam_pulang" class="block text-gray-700">Jam Pulang</label>
                <input type="time" name="jam_pulang" id="jam_pulang" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="hadir">Hadir</option>
                    <option value="terlambat">Terlambat</option>
                    <option value="izin">Izin</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan</button>
        </form>
    </div>
</body>
</html>