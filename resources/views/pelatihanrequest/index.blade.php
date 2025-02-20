<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Permintaan Pelatihan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-600 shadow-lg min-h-screen">
      <div class="p-6">
        <!-- Logo dan Nama Perusahaan -->
        <div class="flex items-center space-x-3">
          <img src="{{ asset('image/sabiru.png') }}" alt="Logo Sabirunya" class="w-10 h-10" style="filter: invert(1);">
          <span class="text-xl font-bold text-white">Samudra Biru</span>
        </div>
        <nav class="mt-8">
          <ul>
            <!-- Data Karyawan -->
            <li class="mb-4">
              <a href="{{ route('admin.tampil') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('admin.tampil') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Data Karyawan
              </a>
            </li>
            <!-- Data Absensi -->
            <li class="mb-4">
              <a href="{{ route('absen.admin.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('absen.admin.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Data Absensi
              </a>
            </li>
            <!-- Data Posisi -->
            <li class="mb-4">
              <a href="{{ route('posisi.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('posisi.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 6h12M6 10h12M6 14h12M6 18h12M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                </svg>
                Data Posisi
              </a>
            </li>
            <!-- Data Gaji -->
            <li class="mb-4">
              <a href="{{ route('gaji.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('gaji.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2 7a2 2 0 012-2h15a2 2 0 012 2v2H2V7z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2 11h20v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6z" />
                </svg>
                Data Gaji
              </a>
            </li>
            <!-- Data Pelatihan -->
            <li class="mb-4">
              <a href="{{ route('pelatihan.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('pelatihan.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.84 4.196c0 2.47-1.115 4.688-2.905 6.072A11.953 11.953 0 0112 21c-1.818 0-3.53-.458-5.095-1.258A7.986 7.986 0 013 14.774a12.083 12.083 0 01.84-4.196L12 14z" />
                </svg>
                Data Pelatihan
              </a>
            </li>
            <!-- Request Pelatihan -->
            <li class="mb-4">
              <a href="{{ route('pelatihanrequest.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('pelatihanrequest.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m-6-8h6m2 12h2a2 2 0 002-2V6a2 2 0 00-2-2h-2M7 4H5a2 2 0 00-2 2v12a2 2 0 002 2h2" />
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
