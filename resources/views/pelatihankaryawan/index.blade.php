<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pelatihan Karyawan</title>
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
        <span class="text-gray-700">{{ Auth::user()->nama }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300">
            Logout
          </button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
      <div class="p-6">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Data Pelatihan</h1>

        <!-- Alert Success (jika ada) -->
        @if (session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
          </div>
        @endif

        <!-- Tabel Data Pelatihan -->
        <div class="overflow-x-auto">
          <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-gray-200 text-gray-700">
                <th class="border border-gray-300 px-6 py-3">No</th>
                <th class="border border-gray-300 px-6 py-3">Nama Pelatihan</th>
                <th class="border border-gray-300 px-6 py-3">Tanggal Pendaftaran</th>
                <th class="border border-gray-300 px-6 py-3">Tanggal Pelatihan</th>
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
                  <td class="px-6 py-4">{{ $data->alamat }}</td>
                  <td class="px-6 py-4">{{ $data->deskripsi }}</td>
                  <td class="px-6 py-4">
                    @php
                      // Ambil request yang diajukan karyawan untuk pelatihan ini
                      $req = $data->requests->where('karyawan_id', Auth::user()->id)->first();
                    @endphp

                    @if($req)
                      @if($req->status == 'pending')
                          <span class="text-yellow-500 font-semibold">Menunggu Persetujuan</span>
                      @elseif($req->status == 'accepted')
                          <span class="text-green-500 font-semibold">Permintaan Diterima</span>
                      @elseif($req->status == 'declined')
                          <span class="text-red-500 font-semibold">Permintaan Ditolak</span>
                      @endif
                    @else
                      <form action="{{ route('pelatihan.join', $data->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                          Ikuti Pelatihan
                        </button>
                      </form>
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
