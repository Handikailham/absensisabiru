<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Panggil Sidebar dengan fixed width agar tidak berubah-ubah -->
    <div class="w-64 flex-shrink-0">
      @include('partials.sidebaradmin')
    </div>
    
    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Header: Judul dan Tombol Tambah Data -->
      <div class="flex justify-between items-end mb-6">
        <h1 class="text-3xl font-semibold text-blue-600">Data Pelatihan</h1>
        <a href="{{ route('pelatihan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md">
          Tambah Pelatihan
        </a>
      </div>

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
          {{ session('success') }}
        </div>
      @endif

      <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border border-gray-300 px-6 py-3">No</th>
              <th class="border border-gray-300 px-6 py-3">Nama Pelatihan</th>
              <th class="border border-gray-300 px-6 py-3">Tanggal Pendaftaran</th>
              <th class="border border-gray-300 px-6 py-3">Tanggal Pelatihan</th>
              <th class="border border-gray-300 px-6 py-3">Waktu Mulai</th>
              <th class="border border-gray-300 px-6 py-3">Waktu Akhir</th>
              <th class="border border-gray-300 px-6 py-3">Alamat</th>
              <th class="border border-gray-300 px-6 py-3">Deskripsi</th>
              <th class="border border-gray-300 px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($pelatihan as $no => $data)
            <tr class="hover:bg-gray-100 text-center border-b">
              <td class="px-6 py-4">{{ $no + 1 }}</td>
              <td class="px-6 py-4">{{ $data->nama_pelatihan }}</td>
              <td class="px-6 py-4">{{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->format('d-m-Y') }}</td>
              <td class="px-6 py-4">{{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->format('d-m-Y') }}</td>
              <td class="px-6 py-4">{{ $data->waktu_mulai }}</td>
              <td class="px-6 py-4">{{ $data->waktu_akhir }}</td>
              <td class="px-6 py-4">{{ $data->alamat }}</td>
              <td class="px-6 py-4">{{ $data->deskripsi }}</td>
              <td class="px-6 py-4">
                <div class="flex justify-center space-x-2">
                  <!-- Tombol Edit dengan ikon pensil -->
                  <a href="{{ route('pelatihan.edit', $data->id) }}" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16 3.5a2.121 2.121 0 113 3L7 21H4v-3L16 3.5z" />
                    </svg>
                  </a>
                  <!-- Tombol Hapus dengan ikon tempat sampah -->
                  <form action="{{ route('pelatihan.delete', $data->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 shadow-md" onclick="return confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')">
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
