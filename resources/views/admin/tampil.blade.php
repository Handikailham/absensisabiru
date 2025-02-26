<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Karyawan</title>
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
<!-- Panggil Sidebar -->
@include('partials.sidebaradmin')
    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Judul dan Tombol Tambah Data sejajar -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-blue-600">Data Karyawan Samudra Biru</h1>
        <a href="{{ route('admin.tambah') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md transition-colors duration-200">
          Tambah Data
        </a>
      </div>

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
          {{ session('success') }}
        </div>
      @endif

      <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border px-6 py-3">No</th>
              <th class="border px-6 py-3">Nama Karyawan</th>
              <th class="border px-6 py-3">Email</th>
              <th class="border px-6 py-3">Posisi</th>
              <th class="border px-6 py-3">Tipe Karyawan</th>
              <th class="border px-6 py-3">Role</th>
              <th class="border px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($karyawan as $no => $data)
            <tr class="hover:bg-gray-100 text-center border-b">
              <td class="px-6 py-4">{{ $no + 1 }}</td>
              <td class="px-6 py-4">{{ $data->nama }}</td>
              <td class="px-6 py-4">{{ $data->email }}</td>
              <td class="px-6 py-4">{{ optional($data->posisi)->nama_posisi ?? 'Admin' }}</td>
              <td class="px-6 py-4">{{ $data->tipe_karyawan }}</td>
              <td class="px-6 py-4 text-blue-600 font-semibold">{{ ucfirst($data->role) }}</td>
              <td class="px-6 py-4">
                <div class="flex justify-center space-x-2">
                  <!-- Tombol Edit dengan ikon pensil -->
                  <a href="{{ route('admin.edit', $data->id) }}" class="text-blue-500 hover:text-blue-600 transition-colors duration-200" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                      <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4.586a1 1 0 01.707.293l7 7a1 1 0 01.293.707V16a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm2 0v10h10v-5.414l-7-7H4z" clip-rule="evenodd"/>
                    </svg>
                  </a>
                  <!-- Tombol Hapus dengan ikon trash -->
                  <form action="{{ route('admin.delete', $data->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:text-blue-600 transition-colors duration-200" title="Hapus">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2h1v9a2 2 0 002 2h6a2 2 0 002-2V6h1a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd"/>
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
