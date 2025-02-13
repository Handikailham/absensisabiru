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
<body class="bg-gray-100 p-6">
  <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
    <div class="p-6">
      <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Riwayat Gaji Saya</h1>
      
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
            <td class="border border-gray-300 px-4 py-2">
              {{ auth()->user()->tipe_karyawan == 'magang' ? '0' : number_format(optional($record->posisi)->gaji_pokok, 0, ',', '.') }}
            </td>
            <td class="border border-gray-300 px-4 py-2">{{ number_format(optional($record->posisi)->tunjangan, 0, ',', '.') }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ number_format($record->lembur, 0, ',', '.') }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ number_format($record->bonus, 0, ',', '.') }}</td>
            <td class="border border-gray-300 px-4 py-2 font-bold text-green-600">{{ number_format($record->total_gaji, 0, ',', '.') }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ date('d M Y', strtotime($record->tanggal_gajian)) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
      <!-- Tombol Kembali -->
      <div class="mt-6 text-center">
          <a href="{{ route('absen.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300">
              Kembali
          </a>
      </div>
      
    </div>
  </div>
</body>
</html>
