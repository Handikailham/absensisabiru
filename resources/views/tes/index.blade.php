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
<body class="bg-gray-100 p-6">
  <div class="container mx-auto max-w-4xl bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
      TES {{ $pelatihan->nama_pelatihan }}
    </h2>
    <div class="bg-gray-50 p-4 rounded-lg" x-data="{ current: 0 }">
      
      <!-- Indikator Soal (Logo Nomor Soal) -->
      <div class="flex justify-end mb-6 pr-4">
        @foreach($currentSubtes->soal as $index => $soal)
          <div class="w-10 h-10 flex items-center justify-center rounded-full mx-1 border-2 transition-all duration-300"
               :class="{
                 'bg-blue-500 text-white border-blue-500 animate-pulse': current === {{ $index }},
                 'bg-gray-200 text-gray-800 border-gray-300': current !== {{ $index }}
               }">
            {{ $index + 1 }}
          </div>
        @endforeach
      </div>
      
      <h3 class="text-xl font-semibold text-gray-700 mb-4 text-center">
        Sub Tes: {{ $currentSubtes->nama_subtes }} (Durasi: {{ $currentSubtes->durasi }} menit)
      </h3>
      
      <!-- Form Soal -->
      <form action="{{ route('pelatihan.submit', [$pelatihan->id, $sub_tes_index]) }}" method="POST">
        @csrf
        @foreach($currentSubtes->soal as $index => $soal)
          <div x-show="current === {{ $index }}" class="mb-4 border-b pb-4">
            <div class="flex">
              <!-- Kolom Soal (kiri) -->
              <div class="w-1/2 pr-4">
                <p class="font-medium text-lg">{{ $loop->iteration }}. {{ $soal->pertanyaan }}</p>
              </div>
              <!-- Kolom Pilihan Jawaban (kanan) -->
              <div class="w-1/2 pl-4 space-y-4">
                @foreach(['a' => $soal->pilihan_a, 'b' => $soal->pilihan_b, 'c' => $soal->pilihan_c, 'd' => $soal->pilihan_d] as $key => $option)
                  <div class="w-full">
                    <!-- Radio input tersembunyi dengan kelas peer -->
                    <input type="radio" id="option-{{ $soal->id }}-{{ $key }}" name="jawaban[{{ $soal->id }}]" value="{{ $key }}" class="hidden peer" required>
                    <label for="option-{{ $soal->id }}-{{ $key }}" class="block w-full flex items-center gap-3 bg-white shadow-md p-3 rounded-lg cursor-pointer transition-all duration-300 ease-in-out transform hover:scale-105 border-2 border-gray-300 peer-checked:bg-blue-200 peer-checked:border-blue-500">
                      <div class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white font-bold rounded-full peer-checked:bg-green-500">
                        {{ strtoupper($key) }}
                      </div>
                      <span class="text-gray-700 peer-checked:text-green-600 flex-1">{{ $option }}</span>
                      <!-- Icon cek muncul jika opsi dipilih -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 hidden peer-checked:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                      </svg>
                    </label>
                  </div>
                @endforeach
              </div>
            </div>
            <!-- Navigasi Soal -->
            <div class="flex justify-between mt-6">
              @if(!$loop->first)
                <button type="button" @click="current--" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition duration-300">
                  KEMBALI
                </button>
              @else
                <span></span>
              @endif
              @if(!$loop->last)
                <button type="button" @click="current++" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-300">
                  NEXT
                </button>
              @else
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-300">
                  SUBMIT SUBTEST
                </button>
              @endif
            </div>
          </div>
        @endforeach
      </form>
    </div>
  </div>
</body>
</html>
