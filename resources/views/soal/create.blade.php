<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Soal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">
    <h1 class="text-2xl font-bold mb-4">Tambah Soal</h1>
    
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('soal.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label for="sub_tes_id" class="block text-sm font-medium text-gray-700">Sub Tes</label>
        <select name="sub_tes_id" id="sub_tes_id" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          <option value="">Pilih Sub Tes</option>
          @foreach($subtes as $sub)
            <option value="{{ $sub->id }}">{{ $sub->nama_subtes }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
        <textarea id="pertanyaan" name="pertanyaan" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <div>
        <label for="pilihan_a" class="block text-sm font-medium text-gray-700">Pilihan A</label>
        <input type="text" id="pilihan_a" name="pilihan_a" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="pilihan_b" class="block text-sm font-medium text-gray-700">Pilihan B</label>
        <input type="text" id="pilihan_b" name="pilihan_b" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="pilihan_c" class="block text-sm font-medium text-gray-700">Pilihan C</label>
        <input type="text" id="pilihan_c" name="pilihan_c" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="pilihan_d" class="block text-sm font-medium text-gray-700">Pilihan D</label>
        <input type="text" id="pilihan_d" name="pilihan_d" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="jawaban_benar" class="block text-sm font-medium text-gray-700">Jawaban Benar (a, b, c, atau d)</label>
        <input type="text" id="jawaban_benar" name="jawaban_benar" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex justify-end">
        <a href="{{ route('soal.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
            Kembali
          </a>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
          Simpan Soal
        </button>
      </div>
    </form>
  </div>
</body>
</html>
