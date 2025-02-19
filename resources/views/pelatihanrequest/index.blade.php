<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Permintaan Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <!-- Navbar -->
  <nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <a href="{{ route('admin.tampil') }}" class="text-gray-800 hover:text-blue-600">Data Karyawan</a>
        <a href="{{ route('absen.admin.index') }}" class="text-gray-800 hover:text-blue-600">Data Absensi</a>
        <a href="{{ route('pelatihan.index') }}" class="text-gray-800 hover:text-blue-600">Data Pelatihan</a>
        <a href="{{ route('pelatihanrequest.index') }}" class="text-blue-600 font-bold">Request Pelatihan</a>
      </div>
      <div class="flex items-center space-x-4">
        <span class="text-gray-700">{{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
      <div class="p-6">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Kelola Permintaan Pelatihan</h1>

        <!-- Tombol Filter Status -->
        <div class="flex space-x-4 mb-4">
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

        <!-- Alert Success -->
        @if (session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
          </div>
        @endif

        <!-- Tabel Request Pelatihan -->
        <div class="overflow-x-auto">
          <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-gray-200 text-gray-700">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Pelatihan</th>
                <th class="border border-gray-300 px-4 py-2">Nama Karyawan</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($requests as $no => $req)
                <tr class="text-center border-b hover:bg-gray-100">
                  <td class="px-4 py-2">{{ $no + 1 }}</td>
                  <td class="px-4 py-2">{{ $req->pelatihan->nama_pelatihan ?? 'N/A' }}</td>
                  <td class="px-4 py-2">{{ $req->karyawan->nama ?? 'N/A' }}</td>
                  <td class="px-4 py-2 capitalize">{{ $req->status }}</td>
                  <td class="px-4 py-2">
                    @if($req->status == 'pending')
                      <div class="flex items-center space-x-2">
                        <!-- Tombol Accept -->
                        <form action="{{ route('pelatihanrequest.update', $req->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="status" value="accepted">
                          <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Accept
                          </button>
                        </form>
                        <!-- Tombol Decline -->
                        <form action="{{ route('pelatihanrequest.update', $req->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="status" value="declined">
                          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
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

      </div>
    </div>
  </div>
</body>
</html>
