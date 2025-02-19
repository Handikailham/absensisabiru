<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Gaji Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <nav class="bg-white shadow-lg sticky top-0 z-10">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo and Links -->
      <div class="flex items-center space-x-6">
        <!-- Logo -->
        <img src="{{ asset('image/sabiru.png') }}" alt="Logo" class="h-12">
        
        <a href="{{ route('absen.index') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('absen.index') ? 'font-bold text-blue-600' : '' }} text-lg">
          Absensi Karyawan
        </a>
        <a href="{{ route('absen.riwayatgaji') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('absen.riwayatgaji') ? 'font-bold text-blue-600' : '' }} text-lg">
          Riwayat Gaji
        </a>
        <a href="{{ route('pelatihankaryawan.index') }}" class="text-gray-800 hover:text-blue-600 {{ request()->routeIs('pelatihankaryawan.index') ? 'font-bold text-blue-600' : '' }} text-lg">
          Pelatihan Karyawan
        </a>
      </div>
  </nav>

    <!-- Content -->
    <div class="flex-1 p-6 bg-white">
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl p-6">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Riwayat Gaji Saya</h2>

            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Posisi</th>
                        <th class="border border-gray-300 px-4 py-2">Gaji Pokok</th>
                        <th class="border border-gray-300 px-4 py-2">Tunjangan</th>
                        <th class="border border-gray-300 px-4 py-2">Lembur</th>
                        <th class="border border-gray-300 px-4 py-2">Bonus</th>
                        <th class="border border-gray-300 px-4 py-2">Total Gaji</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Gajian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gajiRecords as $index => $record)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ optional($record->posisi)->nama_posisi ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ auth()->user()->tipe_karyawan == 'magang' ? '0' : number_format(optional($record->posisi)->gaji_pokok, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format(optional($record->posisi)->tunjangan, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($record->lembur, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($record->bonus, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold text-green-600">{{ number_format($record->total_gaji, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ date('d M Y', strtotime($record->tanggal_gajian)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
