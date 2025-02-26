<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Gaji</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .nominal { color: #2563EB; }
  </style>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-lg mx-auto">
    <h2 class="text-3xl font-bold text-center text-blue-500 mb-6">Tambah Data Gaji</h2>
    <div class="bg-white shadow-md rounded-md p-6">
      @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('gaji.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Pilih Karyawan -->
        <div>
          <label class="block text-gray-700 font-semibold">Nama Karyawan</label>
          <select id="karyawan" name="id_karyawan" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
            <option value="" selected disabled>Pilih Karyawan</option>
            @foreach($karyawan as $data)
              <option value="{{ $data->id }}" 
                      data-posisi="{{ $data->posisi->id ?? '' }}"
                      data-gaji="{{ $data->posisi->gaji_pokok ?? 0 }}"
                      data-tunjangan="{{ $data->posisi->tunjangan ?? 0 }}"
                      data-tipe="{{ $data->tipe_karyawan }}">
                {{ $data->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Gaji Pokok -->
        <div>
          <label class="block text-gray-700 font-semibold">Gaji Pokok</label>
          <input type="text" id="gaji_pokok_display" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 bg-gray-200 nominal" readonly>
          <input type="hidden" id="gaji_pokok" name="gaji_pokok" value="0">
        </div>

        <!-- Tunjangan -->
        <div>
          <label class="block text-gray-700 font-semibold">Tunjangan</label>
          <input type="text" id="tunjangan_display" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 bg-gray-200 nominal" readonly>
          <input type="hidden" id="tunjangan" name="tunjangan" value="0">
        </div>

        <!-- Lembur -->
        <div>
          <label class="block text-gray-700 font-semibold">Lembur</label>
          <input type="text" id="lembur_display" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 nominal" value="0">
          <input type="hidden" id="lembur" name="lembur" value="0">
        </div>

        <!-- Bonus -->
        <div>
          <label class="block text-gray-700 font-semibold">Bonus</label>
          <input type="text" id="bonus_display" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 nominal" value="0">
          <input type="hidden" id="bonus" name="bonus" value="0">
        </div>

        <!-- Total Gaji -->
        <div>
          <label class="block text-gray-700 font-semibold">Total Gaji</label>
          <input type="text" id="total_gaji_display" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 bg-gray-200 nominal" readonly>
          <input type="hidden" id="total_gaji" name="total_gaji" value="0">
        </div>

        <!-- Tanggal Gajian -->
        <div>
          <label class="block text-gray-700 font-semibold">Tanggal Gajian</label>
          <input type="date" name="tanggal_gajian" value="{{ date('Y-m-d') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-between space-x-4">
          <a href="{{ route('gaji.index') }}" class="w-1/2 bg-blue-500 text-white py-2 px-4 text-center rounded-md hover:bg-blue-600">
            Kembali
          </a>
          <button type="submit" class="w-1/2 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
            Simpan Data Gaji
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function formatNominal(value) {
      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  
    function unformatNominal(formatted) {
      return parseInt(formatted.replace(/[^\d]/g, ""), 10) || 0;
    }
  
    function hitungTotalGaji() {
      var gajiPokok = parseFloat($('#gaji_pokok').val()) || 0;
      var tunjangan = parseFloat($('#tunjangan').val()) || 0;
      var lembur = parseFloat($('#lembur').val()) || 0;
      var bonus = parseFloat($('#bonus').val()) || 0;
  
      var total = gajiPokok + tunjangan + lembur + bonus;
      $('#total_gaji').val(total);
      $('#total_gaji_display').val(formatNominal(total));
    }
  
    $(document).ready(function(){
      $('#karyawan').change(function(){
        var selected = $(this).find(':selected');
        console.log("Tipe karyawan:", selected.data('tipe'));
        console.log("Gaji pokok:", selected.data('gaji'));
        console.log("Tunjangan:", selected.data('tunjangan'));
  
        var tipe = selected.data('tipe');
        var gaji = parseFloat(selected.data('gaji')) || 0;
        if(tipe === 'magang'){
          gaji = 0;
        }
        var tunjangan = parseFloat(selected.data('tunjangan')) || 0;
        
        $('#gaji_pokok').val(gaji);
        $('#gaji_pokok_display').val(formatNominal(gaji));
        $('#tunjangan').val(tunjangan);
        $('#tunjangan_display').val(formatNominal(tunjangan));
        
        hitungTotalGaji();
      });
  
      function handleInputFormat(selector, hiddenSelector) {
        $(selector).on('input', function () {
          var rawValue = $(this).val();
          var unformatted = unformatNominal(rawValue);
          $(hiddenSelector).val(unformatted);
          $(this).val(formatNominal(unformatted));
          hitungTotalGaji();
        });
      }
  
      handleInputFormat('#lembur_display', '#lembur');
      handleInputFormat('#bonus_display', '#bonus');
    });
  </script>
</body>
</html>
