<!-- resources/views/partials/navbar.blade.php -->
<nav class="bg-white shadow sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-6">
      <img src="{{ asset('image/sabiru.png') }}" alt="Logo" class="h-10">
      <a href="{{ route('absen.index') }}" class="text-blue-600 font-bold hover:text-blue-600 text-lg">Absensi Karyawan</a>
      <a href="{{ route('absen.riwayatgaji') }}" class="text-gray-700 hover:text-blue-600 text-lg">Riwayat Gaji</a>
      <!-- Dropdown Jadwal Pelatihan -->
      <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center text-gray-700 text-lg focus:outline-none">
          Jadwal Pelatihan
          <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
          </svg>
        </button>
        <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md z-10">
          <a href="{{ route('pelatihankaryawan.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-500 hover:text-white">
            Pelatihan Terbaru
          </a>
          <a href="{{ route('pelatihankaryawan.requested') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-500 hover:text-white">
            Pelatihan Saya
          </a>
        </div>
      </div>
    </div>
    <div class="flex items-center space-x-4">
      <!-- Tampilkan foto profil sebagai link ke halaman edit profil -->
      <a href="{{ route('karyawan.edit.profile') }}">
        @if(Auth::user()->profile_image)
          <img src="{{ asset('storage/profile/' . Auth::user()->profile_image) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
        @else
          <img src="{{ asset('image/default-avatar.png') }}" alt="Default Avatar" class="w-10 h-10 rounded-full object-cover">
        @endif
      </a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-300">
          Logout
        </button>
      </form>
    </div>
  </div>
</nav>
