<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Absensi</h1>

        <!-- Form Filter Berdasarkan Tanggal -->
        <form action="{{ route('absen.admin.filterByDate') }}" method="GET" class="mb-4 bg-white p-4 rounded-lg shadow-md">
            @csrf
            <div class="flex gap-4">
                <div>
                    <label for="start_date" class="block text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="w-full px-4 py-2 border rounded-lg" value="{{ $startDate ?? '' }}" required>
                </div>
                <div>
                    <label for="end_date" class="block text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" class="w-full px-4 py-2 border rounded-lg" value="{{ $endDate ?? '' }}" required>
                </div>
                <div class="self-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Filter</button>
                </div>
            
        </form>

        <form action="{{ route('absen.admin.index') }}" >
            <div class="self-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Reset</button>
            </div>
        </form>
    </div>

        <!-- Tabel Daftar Absensi -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Karyawan</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Jam Masuk</th>
                        <th class="px-4 py-2">Jam Pulang</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absens as $absen)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $absen->karyawan->nama }}</td>
                        <td class="px-4 py-2">{{ $absen->tanggal }}</td>
                        <td class="px-4 py-2">{{ $absen->jam_masuk ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absen->jam_pulang ?? '-' }}</td>
                        <td class="px-4 py-2">{{ ucfirst($absen->status) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('absen.admin.show', $absen->id) }}" class="text-blue-500 hover:underline">Detail</a>
                            <a href="{{ route('absen.admin.edit', $absen->id) }}" class="text-yellow-500 hover:underline ml-2">Edit</a>
                            <form action="{{ route('absen.admin.destroy', $absen->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>