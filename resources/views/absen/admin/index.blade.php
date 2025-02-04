<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
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

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="p-6">
                <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Daftar Absensi</h1>

    <!-- Form Filter Berdasarkan Tanggal -->
    <div class="mb-4 flex justify-between items-center">
        <form action="{{ route('absen.admin.filterByDate') }}" method="GET" class="flex items-end space-x-4">
            @csrf
            <div>
                <label for="start_date" class="block text-sm text-gray-600 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="px-3 py-2 border rounded-lg w-40" value="{{ $startDate ?? '' }}" required>
            </div>
            <div>
                <label for="end_date" class="block text-sm text-gray-600 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="px-3 py-2 border rounded-lg w-40" value="{{ $endDate ?? '' }}" required>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Filter
                </button>
                <a href="{{ route('absen.admin.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">
                    Reset
                </a>
            </div>
        </form>
    
        <!-- Tombol Export ke Excel -->
        @if(isset($startDate) && isset($endDate))
        <div>
            <a href="{{ route('absen.admin.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                Export ke Excel
            </a>
        </div>
        @endif
    </div>
    


                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('absen.admin.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 shadow-md">
                        Tambah Data
                    </a>
                </div>

                <!-- Tabel Daftar Absensi -->
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border border-gray-300 px-6 py-3">No</th>
                                <th class="border border-gray-300 px-6 py-3">Nama Karyawan</th>
                                <th class="border border-gray-300 px-6 py-3">Tanggal</th>
                                <th class="border border-gray-300 px-6 py-3">Jam Masuk</th>
                                <th class="border border-gray-300 px-6 py-3">Jam Pulang</th>
                                <th class="border border-gray-300 px-6 py-3">Status</th>
                                <th class="border border-gray-300 px-6 py-3">Alasan</th>
                                <th class="border border-gray-300 px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($absens as $absen)
                            <tr class="hover:bg-gray-100 text-center border-b">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $absen->karyawan->nama }}</td>
                                <td class="px-6 py-4">{{ $absen->tanggal }}</td>
                                <td class="px-6 py-4">{{ $absen->jam_masuk ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $absen->jam_pulang ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="
                                        @switch($absen->status)
                                            @case('hadir') bg-green-500 @break
                                            @case('izin') bg-yellow-500 @break
                                            @case('sakit') bg-blue-500 @break
                                            @default bg-gray-500
                                        @endswitch
                                        text-white px-2 py-1 rounded-full text-xs">
                                        {{ ucfirst($absen->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $absen->alasan ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('absen.admin.show', $absen->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow-md">
                                            Detail
                                        </a>
                                        <a href="{{ route('absen.admin.edit', $absen->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 shadow-md">
                                            Edit
                                        </a>
                                        <form action="{{ route('absen.admin.destroy', $absen->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 shadow-md" onclick="return confirm('Apakah Anda yakin?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td> 
                            </tr>
                            @endforeach
                        </tbody>
                 </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



{{----}}