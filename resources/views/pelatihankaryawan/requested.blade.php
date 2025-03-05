<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pelatihan Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- CSRF Token untuk AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body { 
      font-family: 'Inter', sans-serif; 
    }
    /* Background fixed dengan gradient dan wave SVG */
    .wave-bg {
      background: linear-gradient(to bottom, #3B82F6, #1D4ED8);
      background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path transform="translate(0,320) scale(1,-1)" fill="%231D4ED8" d="M0,256L40,256C80,256,160,256,240,256C320,256,400,256,480,224C560,192,640,128,720,128C800,128,880,192,960,224C1040,256,1120,256,1200,234.7C1280,213,1360,171,1400,149.3L1440,128L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }
  </style>
</head>
<body class="wave-bg min-h-screen relative">
  <!-- Navbar -->
  @include('partials.navbar')
  
  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-6 py-10">
    <header class="text-center mb-10">
      <h1 class="text-4xl font-bold text-blue-700">Pelatihan Saya</h1>
      <p class="mt-2 text-gray-600">Lihat pelatihan yang telah Anda ajukan.</p>
    </header>

    <!-- Pelatihan Belum Selesai -->
    @if($pelatihanBelumSelesai->isNotEmpty())
  <section class="mb-10">
    <h2 class="text-2xl font-bold text-white bg-black bg-opacity-50 p-2 rounded">
      Pelatihan Belum Selesai
    </h2>
    <div class="space-y-8">
      @foreach ($pelatihanBelumSelesai as $data)
        @php
          // Hitung waktu akhir dan waktu mulai sebagai objek Carbon
          $timeEnd = \Carbon\Carbon::parse($data->tanggal_pelatihan . ' ' . $data->waktu_akhir);
          $timeMulai = \Carbon\Carbon::parse($data->tanggal_pelatihan . ' ' . $data->waktu_mulai);
          $now = \Carbon\Carbon::now();
          // Jika tes sudah dimulai, target untuk countdown adalah waktu_akhir (sebagai timestamp ms)
          // Jika belum dimulai, gunakan target_time (yang sudah diset dari controller) atau waktu_mulai
          $targetTimestamp = $data->tes_started 
              ? $timeEnd->timestamp * 1000 
              : (isset($data->target_time) ? strtotime($data->target_time) * 1000 : $timeMulai->timestamp * 1000);
        @endphp

        <div class="relative bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden transform hover:scale-105 transition duration-300">
          <!-- Background Overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white opacity-20"></div>
          <!-- Icon di pojok kanan -->
          <div class="absolute top-5 right-5 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a2 2 0 011.414.586l2.414 2.414A2 2 0 0117.414 6H19a2 2 0 012 2v10a2 2 0 01-2 2z" />
            </svg>
          </div>
          <div class="relative p-6">
            <h3 class="text-2xl font-bold text-gray-800">{{ $data->nama_pelatihan }}</h3>
            <p class="mt-2 text-gray-600 text-sm">
              <span class="font-semibold">Pendaftaran:</span>
              {{-- Gunakan isoFormat untuk menampilkan tanggal dengan nama bulan --}}
              {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->isoFormat('D MMMM Y') }}
            </p>
            <p class="text-gray-600 text-sm">
              <span class="font-semibold">Pelatihan:</span>
              {{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->isoFormat('D MMMM Y') }}
            </p>
            <p class="text-gray-600 text-sm">
              <span class="font-semibold">Waktu Mulai:</span>
              {{ \Carbon\Carbon::parse($data->waktu_mulai)->format('H:i') }}
            </p>
            <p class="text-gray-600 text-sm">
              <span class="font-semibold">Waktu Akhir:</span>
              {{ \Carbon\Carbon::parse($data->waktu_akhir)->format('H:i') }}
            </p>
            <p class="mt-2 text-gray-600 text-sm">
              <span class="font-semibold">Lokasi:</span> {{ $data->alamat }}
            </p>
            <p class="mt-3 text-gray-700">{{ $data->deskripsi }}</p>
            <p class="mt-4 text-sm text-red-500">*Harap masuk ke form sebelum waktu akhir</p>
          </div>
          <div class="relative p-6 bg-gray-50 border-t border-gray-300">
            @if($data->request_status == 'pending')
              <span class="px-4 py-2 text-lg font-semibold text-yellow-600">Menunggu Persetujuan</span>
            @elseif($data->request_status == 'declined')
              <span class="px-4 py-2 text-lg font-semibold text-red-600">Ditolak</span>
            @elseif($data->request_status == 'accepted')
              @if($now->gte($timeEnd))
                @if(!$data->tes_started)
                  <span class="px-4 py-2 text-lg font-semibold text-red-600">Anda melewatkan pelatihan ini</span>
                  <script>
                    deleteProgress({{ $data->id }});
                  </script>
                @else
                  <a id="final-button-{{ $data->id }}" href="{{ route('pelatihan.hasil', $data->id) }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200 inline-block text-center">
                    Lihat Hasil
                  </a>
                  <script>
                    finishTest({{ $data->id }});
                    deleteProgress({{ $data->id }});
                  </script>
                @endif
              @else
                @if($data->tes_started)
                  <!-- Jika tes sudah dimulai dan waktu belum habis, langsung tampilkan tombol Lanjutkan Tes -->
                  <a href="{{ route('pelatihan.mulai', [$data->id, $data->sub_tes_index]) }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200 inline-block text-center">
                    Lanjutkan Tes
                  </a>
                @else
                  <!-- Jika belum dimulai, tampilkan countdown -->
                  <div id="countdown-{{ $data->id }}" data-target="{{ $targetTimestamp }}" data-pelatihan="{{ $data->id }}" class="text-lg font-semibold text-green-600">
                    Loading countdown...
                  </div>
                  <div id="start-button-{{ $data->id }}" class="hidden">
                    <a href="{{ route('pelatihan.mulai', [$data->id, 0]) }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200 inline-block text-center">
                      Mulai Tes
                    </a>
                  </div>
                @endif
              @endif
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endif


    <!-- Pelatihan Selesai -->
    @if($pelatihanSelesai->isNotEmpty())
      <section class="mb-10">
        <h2 class="text-2xl font-bold text-white bg-black bg-opacity-50 p-2 rounded">
          Pelatihan Selesai
        </h2>
        <div class="space-y-8">
          @foreach ($pelatihanSelesai as $data)
            <div class="relative bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden transform hover:scale-105 transition duration-300">
              <!-- Background Overlay -->
              <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-white opacity-20"></div>
              <!-- Icon di pojok kanan -->
              <div class="absolute top-5 right-5 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a2 2 0 011.414.586l2.414 2.414A2 2 0 0117.414 6H19a2 2 0 012 2v10a2 2 0 01-2 2z" />
                </svg>
              </div>
              <div class="relative p-6">
                <h3 class="text-2xl font-bold text-gray-800">{{ $data->nama_pelatihan }}</h3>
                <p class="mt-2 text-gray-600 text-sm">
                  <span class="font-semibold">Pendaftaran:</span> {{ \Carbon\Carbon::parse($data->tanggal_pendaftaran)->isoFormat('D MMMM Y') }}
                </p>
                <p class="text-gray-600 text-sm">
                  <span class="font-semibold">Pelatihan:</span> {{ \Carbon\Carbon::parse($data->tanggal_pelatihan)->isoFormat('D MMMM Y') }}
                </p>
                <p class="mt-2 text-gray-600 text-sm">
                  <span class="font-semibold">Lokasi:</span> {{ $data->alamat }}
                </p>
                <p class="mt-3 text-gray-700">{{ $data->deskripsi }}</p>
              </div>
              <div class="relative p-6 bg-gray-50 border-t border-gray-300">
                <div class="flex justify-between items-center">
                  <span class="px-4 py-2 text-lg font-semibold text-green-600">Pelatihan Selesai</span>
                  <a href="{{ route('pelatihan.hasil', $data->id) }}" class="px-4 py-2 text-lg font-semibold text-blue-600 hover:underline">
                    Lihat Hasil
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    @endif

    @if($pelatihanSelesai->isEmpty() && $pelatihanBelumSelesai->isEmpty())
      <p class="text-center text-gray-600">Anda belum mengajukan pelatihan apapun.</p>
    @endif
  </div>

  <script>
    // Fungsi update countdown menggunakan timestamp (ms)
    function updateCountdown() {
      document.querySelectorAll('[id^="countdown-"]').forEach(function(el) {
        var targetTime = parseInt(el.getAttribute('data-target')); // Sudah berupa timestamp dalam ms
        var now = new Date().getTime();
        var distance = targetTime - now;
  
        if (distance < 0) {
          el.style.display = 'none';
          var startButton = document.getElementById('start-button-' + el.id.split('-')[1]);
          if(startButton){
            startButton.style.display = 'block';
          }
          // Panggil fungsi untuk menghapus progress dan update status tes selesai
          var pelatihanId = el.getAttribute('data-pelatihan');
          deleteProgress(pelatihanId);
          finishTest(pelatihanId);
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
  
    // Fungsi AJAX untuk menghapus record progress
    function deleteProgress(pelatihanId) {
      if(document.getElementById('progress-deleted-' + pelatihanId)) return;
  
      fetch("{{ url('pelatihan/progress/delete') }}/" + pelatihanId, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content")
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log("Progress dihapus:", data);
        var marker = document.createElement("div");
        marker.id = "progress-deleted-" + pelatihanId;
        document.body.appendChild(marker);
      })
      .catch(error => console.error("Error deleting progress:", error));
    }
  
    // Fungsi AJAX untuk mengupdate status tes selesai
    function finishTest(pelatihanId) {
      if(document.getElementById('tes-finished-' + pelatihanId)) return;
  
      fetch("{{ url('pelatihan/tes/finish') }}/" + pelatihanId, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content")
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log("Tes selesai diperbarui:", data);
        var marker = document.createElement("div");
        marker.id = "tes-finished-" + pelatihanId;
        document.body.appendChild(marker);
      })
      .catch(error => console.error("Error finishing test:", error));
    }
  </script>
</body>
</html>
