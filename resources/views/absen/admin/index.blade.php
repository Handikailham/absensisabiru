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
        <form action="{{ route('absen.admin.filterByDate') }}" method="GET" class="flex items-end space-x-4 -ml-2">
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
                  <!-- Tombol Detail dengan icon mata -->
                  <a href="{{ route('absen.admin.show', $absen->id) }}" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md" title="Detail">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </a>
                  <!-- Tombol Edit dengan icon pensil -->
                  <a href="{{ route('absen.admin.edit', $absen->id) }}" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16 3.5a2.121 2.121 0 113 3L7 21H4v-3L16 3.5z" />
                    </svg>
                  </a>
                  <!-- Tombol Hapus dengan icon tempat sampah -->
                  <form action="{{ route('absen.admin.destroy', $absen->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md" title="Hapus" onclick="return confirm('Apakah Anda yakin?')">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                      </svg>
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
