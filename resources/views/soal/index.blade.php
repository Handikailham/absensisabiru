<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Soal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Panggil Sidebar -->
    @include('partials.sidebaradmin')

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Header: Judul dan Tombol Tambah Soal sejajar -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-blue-600">Daftar Soal</h1>
        <a href="{{ route('soal.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
          Tambah Soal
        </a>
      </div>

      <!-- Tabel Daftar Soal -->
      <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border px-6 py-3">No</th>
              <th class="border px-6 py-3">Pelatihan</th>
              <th class="border px-6 py-3">Sub Tes</th>
              <th class="border px-6 py-3">Pertanyaan</th>
              <th class="border px-6 py-3">Pilihan A</th>
              <th class="border px-6 py-3">Pilihan B</th>
              <th class="border px-6 py-3">Pilihan C</th>
              <th class="border px-6 py-3">Pilihan D</th>
              <th class="border px-6 py-3">Jawaban Benar</th>
              <th class="border px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($soals as $index => $soal)
              <tr class="hover:bg-gray-100 text-center border-b">
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ optional($soal->subtes->pelatihan)->nama_pelatihan ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ optional($soal->subtes)->nama_subtes ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $soal->pertanyaan }}</td>
                <td class="px-6 py-4">{{ $soal->pilihan_a }}</td>
                <td class="px-6 py-4">{{ $soal->pilihan_b }}</td>
                <td class="px-6 py-4">{{ $soal->pilihan_c }}</td>
                <td class="px-6 py-4">{{ $soal->pilihan_d }}</td>
                <td class="px-6 py-4">{{ strtoupper($soal->jawaban_benar) }}</td>
                <td class="px-6 py-4">
                  <div class="flex justify-center space-x-2">
                    <!-- Tombol Edit dengan ikon pensil -->
                    <a href="{{ route('soal.edit', $soal->id) }}" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16 3.5a2.121 2.121 0 113 3L7 21H4v-3L16 3.5z" />
                      </svg>
                    </a>
                    <!-- Tombol Hapus dengan ikon tempat sampah -->
                    <form action="{{ route('soal.destroy', $soal->id) }}" method="POST" class="inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md" onclick="return confirm('Anda yakin ingin menghapus soal ini?')">
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
