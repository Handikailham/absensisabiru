<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
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
            <div class="mb-4">
                <label for="alasan" class="block text-gray-700">Alasan</label>
                <input type="text" name="alasan" id="alasan" class="w-full px-4 py-2 border rounded-lg" >
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan</button>
        </form>
    </div>
</body>
</html>