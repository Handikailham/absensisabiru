<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Absensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
<!-- Panggil Sidebar -->
@include('partials.sidebaradmin')
    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Judul Halaman -->
      <h1 class="text-3xl font-semibold text-blue-600 mb-6">Daftar Absensi</h1>

      <!-- Baris Form Filter dan Tombol Tambah Data -->
      <div class="flex justify-between items-end mb-6">
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
            <a href="{{ route('absen.admin.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
              Reset
            </a>
          </div>
        </form>
        <a href="{{ route('absen.admin.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md transition-colors duration-200">
          Tambah Data
        </a>
      </div>

      <!-- Tombol Export ke Excel (jika ada filter) -->
      @if(isset($startDate) && isset($endDate))
      <div class="mb-6">
        <a href="{{ route('absen.admin.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
          Export ke Excel
        </a>
      </div>
      @endif

      <!-- Tabel Daftar Absensi -->
      <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border px-6 py-3">No</th>
              <th class="border px-6 py-3">Nama Karyawan</th>
              <th class="border px-6 py-3">Tanggal</th>
              <th class="border px-6 py-3">Jam Masuk</th>
              <th class="border px-6 py-3">Jam Pulang</th>
              <th class="border px-6 py-3">Status</th>
              <th class="border px-6 py-3">Alasan</th>
              <th class="border px-6 py-3">Aksi</th>
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
                  <a href="{{ route('absen.admin.edit', $absen->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow-md">
                    Edit
                  </a>
                  <form action="{{ route('absen.admin.destroy', $absen->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow-md" onclick="return confirm('Apakah Anda yakin?')">
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
    </main>
  </div>
</body>
</html>
