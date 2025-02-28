<!-- resources/views/partials/sidebaradmin.blade.php -->
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
            Data Karyawan
          </a>
        </li>
        <!-- Data Absensi -->
        <li class="mb-4">
          <a href="{{ route('absen.admin.index') }}"
             class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('absen.admin.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
            Data Absensi
          </a>
        </li>
        <!-- Data Posisi -->
        <li class="mb-4">
          <a href="{{ route('posisi.index') }}"
             class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('posisi.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
            Data Posisi
          </a>
        </li>
        <!-- Data Gaji -->
        <li class="mb-4">
          <a href="{{ route('gaji.index') }}"
             class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('gaji.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
            Data Gaji
          </a>
        </li>
        <!-- Dropdown Pelatihan -->
        <li x-data="{ open: false }" class="mb-4">
          <button @click="open = !open"
                  class="w-full text-left block px-4 py-2 rounded transition-colors duration-200 text-white hover:bg-blue-700"
                  :class="open ? 'font-bold bg-blue-700' : ''">
            Pelatihan
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
          </button>
          <ul x-show="open" @click.away="open = false" class="mt-2 pl-4">
            <li class="mb-2">
              <a href="{{ route('pelatihan.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 text-white hover:bg-blue-700">
                Data Pelatihan
              </a>
            </li>
            <li class="mb-2">
              <a href="{{ route('pelatihanrequest.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 text-white hover:bg-blue-700">
                Request Pelatihan
              </a>
            </li>
            <li class="mb-2">
              <a href="{{ route('soal.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 text-white hover:bg-blue-700">
                Data Soal
              </a>
            </li>
            <li class="mb-2">
              <a href="{{ route('subtes.index') }}"
                 class="block px-4 py-2 rounded transition-colors duration-200 text-white hover:bg-blue-700">
                Data Subtest
              </a>
            </li>
          </ul>
        </li>
        <!-- Data Hasil Tes -->
        <li class="mb-4">
          <a href="{{ route('hasiltes.index') }}"
             class="block px-4 py-2 rounded transition-colors duration-200 {{ request()->routeIs('hasiltes.index') ? 'font-bold bg-blue-700' : 'hover:bg-blue-700' }} text-white">
            Hasil Tes
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="p-6 border-t border-blue-500">
    <div class="text-white mb-3">{{ Auth::user()->name }}</div>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit"
              class="w-full bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors duration-200">
        Logout
      </button>
    </form>
  </div>
</aside>
