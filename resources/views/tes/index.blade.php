<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pelatihan Terdahulu</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  <!-- Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    [x-cloak] { display: none !important; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Navbar (opsional) -->
  @include('partials.navbar')

  <!-- Container Utama dengan AlpineJS -->
  <div 
    x-data="{
      current: 0,
      timeLeft: {{ $currentSubtes->durasi * 60 ?? 1800 }},
      showConfirm: false,
      answers: {},
      formatTime(t) {
        let m = Math.floor(t / 60);
        let s = t % 60;
        return (m < 10 ? '0' + m : m) + ':' + (s < 10 ? '0' + s : s);
      },
      submitTest() {
        if(this.timeLeft > 0) {
          this.showConfirm = true;
        } else {
          this.$refs.quizForm.submit();
        }
      }
    }"
    x-init="
      setInterval(() => {
        if(timeLeft > 0) { timeLeft--; }
      }, 1000);
    "
    x-effect="if(timeLeft === 0){ $refs.quizForm.submit(); }"
    class="max-w-7xl mx-auto px-4 py-4 relative"
  >

    <!-- BARIS 1: Nama Subtes, Timer & Tombol Kumpulkan -->
    <div class="flex items-center justify-between mb-4">
      <div class="text-lg font-bold text-gray-700">
        {{ $currentSubtes->nama_subtes ?? 'Nama Subtes' }}
      </div>
      <div class="flex items-center space-x-4">
        <div class="text-lg font-semibold text-blue-600">
          <span x-text="formatTime(timeLeft)"></span>
        </div>
        <button
          type="button"
          @click="submitTest()"
          class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition"
        >
          Kumpulkan
        </button>
      </div>
    </div>

    <!-- BARIS 2: Navigasi Soal -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4 space-y-4 md:space-y-0">
      <div class="bg-white shadow-md p-4 rounded-md w-full flex items-center justify-between">
        <div class="text-gray-700 font-semibold">
          Soal <span x-text="current + 1"></span> / {{ count($currentSubtes->soal) }}
        </div>
        <div class="flex items-center flex-wrap gap-2">
          @foreach($currentSubtes->soal as $index => $soal)
            <div 
              class="w-10 h-10 flex items-center justify-center rounded-full cursor-pointer text-sm font-bold border-2 transition-all duration-300"
              :class="{
                'bg-blue-500 text-white border-blue-500 shadow-md scale-105': current === {{ $index }},
                'bg-gray-200 text-gray-700 border-gray-300 hover:bg-gray-300': current !== {{ $index }}
              }"
              @click="current = {{ $index }}"
            >
              {{ $index + 1 }}
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- BARIS 3: Card Berisi Soal dan Opsi Jawaban -->
    <div class="bg-white shadow-md rounded-md p-4 h-[calc(100vh-4rem)] overflow-y-auto">
      <form 
        id="quizForm" 
        action="{{ route('pelatihan.submit', [$pelatihan->id, $sub_tes_index]) }}" 
        method="POST" 
        x-ref="quizForm"
      >
        @csrf

        @foreach($currentSubtes->soal as $index => $soal)
          <div x-show="current === {{ $index }}" class="mb-4">
            <div class="flex flex-col md:flex-row gap-4">
              <!-- Kotak Soal -->
              <div class="w-full md:w-1/2">
                <div class="border border-gray-200 p-4 rounded h-full">
                  <div class="mb-4 text-lg font-semibold text-gray-800">
                    {{ $loop->iteration }}. {{ $soal->pertanyaan }}
                  </div>
                  <!-- Tambahkan gambar atau penjelasan jika diperlukan -->
                </div>
              </div>

              <!-- Kotak Opsi Jawaban dengan tampilan referensi -->
              <div class="w-full md:w-1/2">
                <div class="border border-gray-200 p-4 rounded space-y-4">
                  @foreach(['a' => $soal->pilihan_a, 'b' => $soal->pilihan_b, 'c' => $soal->pilihan_c, 'd' => $soal->pilihan_d] as $key => $option)
                    <label 
                      for="option-{{ $soal->id }}-{{ $key }}"
                      class="block rounded-lg shadow cursor-pointer transition relative p-3 border border-gray-300 bg-white text-gray-800 hover:bg-gray-50"
                      :class="answers['{{ $soal->id }}'] === '{{ $key }}' ? 'bg-blue-100 border-blue-600 text-blue-800 shadow-xl' : ''"
                    >
                      <input 
                        type="radio" 
                        id="option-{{ $soal->id }}-{{ $key }}" 
                        name="jawaban[{{ $soal->id }}]" 
                        value="{{ $key }}" 
                        class="hidden"
                        x-model="answers['{{ $soal->id }}']"
                        required
                      />
                      <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-white font-bold bg-blue-500 text-white">
                          {{ strtoupper($key) }}
                        </div>
                        <div class="text-base font-medium">
                          {{ $option }}
                        </div>
                      </div>
                      <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        x-show="answers['{{ $soal->id }}'] === '{{ $key }}'"
                        class="h-5 w-5 text-blue-500 absolute top-3 right-3" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                      </svg>
                    </label>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endforeach

      </form>
    </div>

    <!-- Navigasi Fixed di Bagian Bawah -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-2xl p-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="w-1/2 text-left">
          <button 
            type="button" 
            @click="current--" 
            x-show="current > 0" 
            class="bg-white border border-gray-300 text-gray-700 px-12 py-3 rounded-full font-semibold transition hover:bg-gray-100"
          >
            KEMBALI
          </button>
        </div>
        <div class="w-1/2 text-right">
          <button 
            type="button" 
            @click="current++" 
            x-show="current < {{ count($currentSubtes->soal) - 1 }}" 
            class="bg-orange-500 hover:bg-orange-600 text-white px-12 py-3 rounded-full font-semibold transition"
          >
            NEXT
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Submit -->
    <div 
      x-show="showConfirm" 
      x-cloak 
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi</h2>
        <p class="mb-6 text-gray-600">Waktu tes masih ada. Apakah Anda yakin ingin mengumpulkan tes?</p>
        <div class="flex justify-end space-x-4">
          <button 
            type="button" 
            @click="showConfirm = false" 
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded transition"
          >
            Batal
          </button>
          <button 
            type="button" 
            @click="$refs.quizForm.submit()" 
            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded transition"
          >
            Ya, Kumpulkan
          </button>
        </div>
      </div>
    </div>

  </div>
</body>
</html>