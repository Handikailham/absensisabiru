<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Soal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Edit Soal</h2>

  <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-600 rounded">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('soal.update', $soal->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label for="sub_tes_id" class="block text-sm font-medium text-gray-700">Sub Tes</label>
        <select name="sub_tes_id" id="sub_tes_id" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Pilih Sub Tes</option>
          @foreach($subtes as $sub)
            <option value="{{ $sub->id }}" {{ $soal->sub_tes_id == $sub->id ? 'selected' : '' }}>{{ $sub->nama_subtes }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
        <textarea id="pertanyaan" name="pertanyaan" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
      </div>

      <div>
        <label for="pilihan_a" class="block text-sm font-medium text-gray-700">Pilihan A</label>
        <input type="text" id="pilihan_a" name="pilihan_a" value="{{ old('pilihan_a', $soal->pilihan_a) }}" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="pilihan_b" class="block text-sm font-medium text-gray-700">Pilihan B</label>
        <input type="text" id="pilihan_b" name="pilihan_b" value="{{ old('pilihan_b', $soal->pilihan_b) }}" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="pilihan_c" class="block text-sm font-medium text-gray-700">Pilihan C</label>
        <input type="text" id="pilihan_c" name="pilihan_c" value="{{ old('pilihan_c', $soal->pilihan_c) }}" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="pilihan_d" class="block text-sm font-medium text-gray-700">Pilihan D</label>
        <input type="text" id="pilihan_d" name="pilihan_d" value="{{ old('pilihan_d', $soal->pilihan_d) }}" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="jawaban_benar" class="block text-sm font-medium text-gray-700">Jawaban Benar (a, b, c, atau d)</label>
        <input type="text" id="jawaban_benar" name="jawaban_benar" value="{{ old('jawaban_benar', $soal->jawaban_benar) }}" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex justify-between">
        <a href="{{ route('soal.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
          Kembali
        </a>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
          Update Soal
        </button>
      </div>
    </form>
  </div>
</body>
</html>
