<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pelatihan Terdahulu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <!--navbar-->
  @include('partials.navbar')  
  
  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-6 py-10">
    <header class="text-center mb-10">
      <h1 class="text-4xl font-bold text-blue-700">Pelatihan Terdahulu</h1>
      <p class="mt-2 text-gray-600">Lihat status pelatihan yang telah Anda ajukan.</p>
    </header>
    
    @if($pelatihan->isNotEmpty())
    <div class="space-y-8">
      @foreach ($pelatihan as $data)
      <div class="relative bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden transform hover:scale-105 transition duration-300">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white opacity-50"></div>
        <!-- Icon di pojok kanan -->
        <div class="absolute top-5 right-5 z-10">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a2 2 0 011.414.586l2.414 2.414A2 2 0 0117.414 6H19a2 2 0 012 2v10a2 2 0 01-2 2z" />
          </svg>
        </div>
        <div class="relative p-6">
          <h3 class="text-2xl font-bold text-gray-800">{{ $data->nama_pelatihan }}</h3>
          <p class="mt-2 text-gray-600 text-sm">
            <span class="font-semibold">Pendaftaran:</span> {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->format('d-m-Y') }}
          </p>
          <p class="text-gray-600 text-sm">
            <span class="font-semibold">Pelatihan:</span> {{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->format('d-m-Y') }}
          </p>
          <p class="mt-2 text-gray-600 text-sm">
            <span class="font-semibold">Lokasi:</span> {{ $data->alamat }}
          </p>
          <p class="mt-3 text-gray-700">{{ $data->deskripsi }}</p>
        </div>
        <div class="relative p-6 bg-gray-50 border-t border-gray-300">
          @if(isset($data->request_status))
            @if($data->request_status == 'pending')
              <span class="px-4 py-2 text-lg font-semibold text-yellow-600">Menunggu Persetujuan</span>
            @elseif($data->request_status == 'declined')
              <span class="px-4 py-2 text-lg font-semibold text-red-600">Ditolak</span>
            @elseif($data->request_status == 'accepted')
              <div id="countdown-{{ $data->id }}" data-target="{{ $data->target_time }}" class="text-lg font-semibold text-green-600">
                Loading countdown...
              </div>
              <div id="start-button-{{ $data->id }}" class="hidden">
                <a href="{{ route('pelatihan.mulai', $data->id) }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200 inline-block text-center">
                  Mulai / Lanjutkan Pelatihan
                </a>
              </div>
            @endif
          @else
            <form action="{{ route('pelatihan.join', $data->id) }}" method="POST">
              @csrf
              <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition duration-200">
                Ikuti Pelatihan
              </button>
            </form>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    @else
    <p class="text-center text-gray-600">Anda belum mengajukan pelatihan apapun.</p>
    @endif
  </div>

  <script>
    // Fungsi update countdown untuk setiap pelatihan yang diterima
    function updateCountdown() {
      document.querySelectorAll('[id^="countdown-"]').forEach(function(el) {
        var targetTime = el.getAttribute('data-target'); // Format: Y-m-d H:i:s
        var countDownDate = new Date(targetTime).getTime();
        var now = new Date().getTime();
        var distance = countDownDate - now;
  
        if (distance < 0) {
          // Jika waktu sudah tiba, sembunyikan countdown dan tampilkan tombol Mulai / Lanjutkan Pelatihan
          el.style.display = 'none';
          var startButton = document.getElementById('start-button-' + el.id.split('-')[1]);
          if(startButton){
            startButton.style.display = 'block';
          }
        } else {
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          el.innerHTML = days + " hari " + hours + " jam " + minutes + " menit " + seconds + " detik";
        }
      });
    }
  
    setInterval(updateCountdown, 1000);
  </script>
</body>
</html>
