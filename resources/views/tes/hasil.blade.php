
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Hasil Tes - {{ $pelatihan->nama_pelatihan }}</h2>
    
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <p class="text-lg mb-2"><strong>Total Soal:</strong> {{ $hasil->total_soal }}</p>
        <p class="text-lg mb-2"><strong>Jumlah Benar:</strong> {{ $hasil->jumlah_benar }}</p>
        <p class="text-lg mb-2"><strong>Jumlah Salah:</strong> {{ $hasil->jumlah_salah }}</p>
        <p class="text-xl font-bold mb-2"><strong>Skor:</strong> {{ number_format(($hasil->total_soal > 0 ? ($hasil->jumlah_benar / $hasil->total_soal) * 100 : 0), 2) }}%</p>
        <p class="text-xl font-bold {{ $hasil->status == 'kompeten' ? 'text-green-600' : 'text-red-600' }}">
            Status: {{ ucfirst($hasil->status) }}
        </p>
    </div>
    
    
</div>

