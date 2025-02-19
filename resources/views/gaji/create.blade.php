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
      /* Class untuk menampilkan nominal dengan teks berwarna biru */
      .nominal { color: #2563EB; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
      <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Tambah Data Gaji</h1>

      @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action="{{ route('gaji.store') }}" method="POST">
        @csrf

        <!-- Pilih Karyawan -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Nama Karyawan</label>
          <select id="karyawan" name="id_karyawan" class="w-full p-2 border border-gray-300 rounded-lg">
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
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Gaji Pokok</label>
          <!-- Tampilan dengan format angka -->
          <input type="text" id="gaji_pokok_display" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-200 nominal" readonly>
          <!-- Hidden input menyimpan nilai mentah -->
          <input type="hidden" id="gaji_pokok" name="gaji_pokok" value="0">
        </div>

        <!-- Tunjangan -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Tunjangan</label>
          <input type="text" id="tunjangan_display" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-200 nominal" readonly>
          <input type="hidden" id="tunjangan" name="tunjangan" value="0">
        </div>

        <!-- Lembur -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Lembur</label>
          <input type="text" id="lembur_display" class="w-full p-2 border border-gray-300 rounded-lg nominal" value="0">
          <input type="hidden" id="lembur" name="lembur" value="0">
        </div>

        <!-- Bonus -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Bonus</label>
          <input type="text" id="bonus_display" class="w-full p-2 border border-gray-300 rounded-lg nominal" value="0">
          <input type="hidden" id="bonus" name="bonus" value="0">
        </div>

        <!-- Total Gaji -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Total Gaji</label>
          <input type="text" id="total_gaji_display" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-200 nominal" readonly>
          <input type="hidden" id="total_gaji" name="total_gaji" value="0">
        </div>

        <!-- Tanggal Gajian -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold">Tanggal Gajian</label>
          <input type="date" name="tanggal_gajian" value="{{ date('Y-m-d') }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
          Simpan Data Gaji
        </button>
      </form>
    </div>
  </div>

  <script>
    // Fungsi untuk memformat angka dengan pemisah ribuan (tanpa Rp)
    function formatNominal(value) {
      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  
    // Fungsi untuk menghapus format dan mengambil angka mentah
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
  // Saat karyawan dipilih, perbarui gaji pokok & tunjangan
  $('#karyawan').change(function(){
    var selected = $(this).find(':selected');
    var tipe = selected.data('tipe'); // ambil tipe karyawan
    var gaji = parseFloat(selected.data('gaji')) || 0;
    // Jika tipe magang, gaji pokok diset ke 0
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
  
  // Fungsi umum untuk format input angka secara otomatis
  function handleInputFormat(selector, hiddenSelector) {
    $(selector).on('input', function () {
      var rawValue = $(this).val();
      var unformatted = unformatNominal(rawValue);
      $(hiddenSelector).val(unformatted); // simpan angka mentah
      $(this).val(formatNominal(unformatted)); // tampilkan dengan format ribuan
      hitungTotalGaji();
    });
  }
  
  handleInputFormat('#lembur_display', '#lembur');
  handleInputFormat('#bonus_display', '#bonus');
});

  </script>
  
</body>
</html>
