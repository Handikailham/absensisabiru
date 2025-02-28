<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Gaji</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Panggil Sidebar dengan fixed width agar tidak mengecil -->
    <div class="w-64 flex-shrink-0">
      @include('partials.sidebaradmin')
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Baris judul dan tombol tambah data -->
      <div class="flex justify-between items-end mb-6">
        <h1 class="text-3xl font-semibold text-blue-600">Data Gaji Karyawan</h1>
        <a href="{{ route('gaji.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md transition-colors duration-200">
          Tambah Data
        </a>
      </div>

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
          {{ session('success') }}
        </div>
      @endif

      <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border px-6 py-3 whitespace-nowrap">No</th>
              <th class="border px-6 py-3 whitespace-nowrap">Nama Karyawan</th>
              <th class="border px-6 py-3 whitespace-nowrap">Posisi</th>
              <th class="border px-6 py-3 whitespace-nowrap">Gaji Pokok</th>
              <th class="border px-6 py-3 whitespace-nowrap">Tunjangan</th>
              <th class="border px-6 py-3 whitespace-nowrap">Lembur</th>
              <th class="border px-6 py-3 whitespace-nowrap">Bonus</th>
              <th class="border px-6 py-3 whitespace-nowrap">Total Gaji</th>
              <th class="border px-6 py-3 whitespace-nowrap">Tanggal Gajian</th>
              <th class="border px-6 py-3 whitespace-nowrap">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($gaji as $no => $item)
            <tr class="hover:bg-gray-100 text-center border-b">
              <td class="px-6 py-4 whitespace-nowrap">{{ $no + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ optional($item->karyawan)->nama ?? 'N/A' }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ optional($item->posisi)->nama_posisi ?? 'N/A' }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{ number_format(optional($item->karyawan)->tipe_karyawan == 'magang' ? 0 : optional($item->posisi)->gaji_pokok, 0, ',', '.') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->posisi->tunjangan, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->lembur, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->bonus, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">{{ number_format($item->total_gaji, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ date('d M Y', strtotime($item->tanggal_gajian)) }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex justify-center">
                  <a href="{{ route('gaji.export.one', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow-md">
                    Ekspor PDF
                  </a>
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
