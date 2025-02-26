
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Tes - {{ $pelatihan->nama_pelatihan }}</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">
            Sub Tes: {{ $currentSubtes->nama_subtes }} (Durasi: {{ $currentSubtes->durasi }} menit)
        </h3>
        <form action="{{ route('pelatihan.submit', [$pelatihan->id, $sub_tes_index]) }}" method="POST">
            @csrf
            @foreach($currentSubtes->soal as $soal)
                <div class="mb-4 border-b pb-4">
                    <p class="font-medium">{{ $loop->iteration }}. {{ $soal->pertanyaan }}</p>
                    <div class="ml-4 mt-2">
                        <label class="block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="a" required>
                            A. {{ $soal->pilihan_a }}
                        </label>
                        <label class="block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="b" required>
                            B. {{ $soal->pilihan_b }}
                        </label>
                        <label class="block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="c" required>
                            C. {{ $soal->pilihan_c }}
                        </label>
                        <label class="block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="d" required>
                            D. {{ $soal->pilihan_d }}
                        </label>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
                Submit Sub Tes
            </button>
        </form>
    </div>
</div>

