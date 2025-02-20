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
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-600 shadow-lg min-h-screen">
        <div class="p-6">
          <div class="flex items-center space-x-3">
            <img src="{{ asset('image/sabiru.png') }}" alt="Logo Sabirunya" class="w-10 h-10" style="filter: invert(1);">
            <span class="text-xl font-bold text-white">Samudra Biru</span>
          </div>
          <nav class="mt-8">
            <ul>
              <!-- Data Karyawan -->
              <li class="mb-4">
                <a href="{{ route('admin.tampil') }}" class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('admin.tampil') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  Data Karyawan
                </a>
              </li>
              <!-- Data Absensi -->
              <li class="mb-4">
                <a href="{{ route('absen.admin.index') }}" class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('absen.admin.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Data Absensi
                </a>
              </li>
              <!-- Data Posisi -->
              <li class="mb-4">
                <a href="{{ route('posisi.index') }}" class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('posisi.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6h12M6 10h12M6 14h12M6 18h12M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2" />
                  </svg>
                  Data Posisi
                </a>
              </li>
              <!-- Data Gaji -->
              <li class="mb-4">
                <a href="{{ route('gaji.index') }}" class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('gaji.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 7a2 2 0 012-2h15a2 2 0 012 2v2H2V7z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 11h20v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6z" />
                  </svg>
                  Data Gaji
                </a>
              </li>
              <!-- Data Pelatihan -->
              <li class="mb-4">
                <a href="{{ route('pelatihan.index') }}" class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('pelatihankaryawan.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                  <!-- Icon academic-cap -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.84 4.196c0 2.47-1.115 4.688-2.905 6.072A11.953 11.953 0 0112 21c-1.818 0-3.53-.458-5.095-1.258A7.986 7.986 0 013 14.774a12.083 12.083 0 01.84-4.196L12 14z" />
                  </svg>
                  Data Pelatihan
                </a>
              </li>
              <!-- Request Pelatihan -->
              <li class="mb-4">
                <a href="{{ route('pelatihanrequest.index') }}" class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('pelatihanrequest.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                  <!-- Icon document-text -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6m2 12h2a2 2 0 002-2V6a2 2 0 00-2-2h-2M7 4H5a2 2 0 00-2 2v12a2 2 0 002 2h2" />
                  </svg>
                  Request Pelatihan
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="p-6 border-t border-blue-500">
          <div class="text-white mb-3">{{ Auth::user()->name }}</div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors duration-200">
              Logout
            </button>
          </form>
        </div>
      </aside>
      

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
