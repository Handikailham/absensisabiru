<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Absensi</h1>

        <!-- Form Edit Absensi -->
        <form action="{{ route('absen.admin.update', $absen->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="karyawan_id" class="block text-gray-700">Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="w-full px-4 py-2 border rounded-lg" required>
                    @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}" {{ $absen->karyawan_id == $karyawan->id ? 'selected' : '' }}>{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-2 border rounded-lg" value="{{ $absen->tanggal }}" required>
            </div>
            <div class="mb-4">
                <label for="jam_masuk" class="block text-gray-700">Jam Masuk</label>
                <input type="time" name="jam_masuk" id="jam_masuk" class="w-full px-4 py-2 border rounded-lg" value="{{ $absen->jam_masuk }}">
            </div>
            <div class="mb-4">
                <label for="jam_pulang" class="block text-gray-700">Jam Pulang</label>
                <input type="time" name="jam_pulang" id="jam_pulang" class="w-full px-4 py-2 border rounded-lg" value="{{ $absen->jam_pulang }}">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="hadir" {{ $absen->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="terlambat" {{ $absen->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    <option value="izin" {{ $absen->status == 'izin' ? 'selected' : '' }}>Izin</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
        </form>
    </div>
</body>
</html>