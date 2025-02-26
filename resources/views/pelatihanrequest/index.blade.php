<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Permintaan Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
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
      <!-- Header: Judul -->
      <div class="flex justify-between items-end mb-6">
        <h1 class="text-3xl font-semibold text-blue-600">Kelola Permintaan Pelatihan</h1>
      </div>

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
          {{ session('success') }}
        </div>
      @endif

      <!-- Tombol Filter Status -->
      <div class="flex space-x-4 mb-6">
        <a href="{{ route('pelatihanrequest.index', ['status' => 'pending']) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded {{ $status == 'pending' ? 'font-bold' : '' }}">
           Pending
        </a>
        <a href="{{ route('pelatihanrequest.index', ['status' => 'accepted']) }}"
           class="bg-green-500 text-white px-4 py-2 rounded {{ $status == 'accepted' ? 'font-bold' : '' }}">
           Accepted
        </a>
        <a href="{{ route('pelatihanrequest.index', ['status' => 'declined']) }}"
           class="bg-red-500 text-white px-4 py-2 rounded {{ $status == 'declined' ? 'font-bold' : '' }}">
           Declined
        </a>
      </div>

      <!-- Tabel Request Pelatihan -->
      <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border border-gray-300 px-6 py-3">No</th>
              <th class="border border-gray-300 px-6 py-3">Nama Pelatihan</th>
              <th class="border border-gray-300 px-6 py-3">Nama Karyawan</th>
              <th class="border border-gray-300 px-6 py-3">Status</th>
              <th class="border border-gray-300 px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($requests as $no => $req)
              <tr class="hover:bg-gray-100 text-center border-b">
                <td class="px-6 py-4">{{ $no + 1 }}</td>
                <td class="px-6 py-4">{{ $req->pelatihan->nama_pelatihan ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $req->karyawan->nama ?? 'N/A' }}</td>
                <td class="px-6 py-4 capitalize">{{ $req->status }}</td>
                <td class="px-6 py-4">
                  @if($req->status == 'pending')
                    <div class="flex justify-center space-x-2">
                      <!-- Tombol Accept -->
                      <form action="{{ route('pelatihanrequest.update', $req->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 shadow-md">
                          Accept
                        </button>
                      </form>
                      <!-- Tombol Decline -->
                      <form action="{{ route('pelatihanrequest.update', $req->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="declined">
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 shadow-md">
                          Decline
                        </button>
                      </form>
                    </div>
                  @else
                    <span class="px-4 py-2 capitalize">{{ $req->status }}</span>
                  @endif
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
