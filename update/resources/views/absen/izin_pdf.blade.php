<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pengajuan Izin</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 30px; /* Sedikit dikurangi agar muat di satu halaman */
            font-size: 12pt;
        }
        .header {
            text-align: center;
            position: relative;
            margin-bottom: 15px; /* Mengurangi margin agar hemat ruang */
        }
        .logo {
            width: 70px; /* Logo sedikit diperkecil */
            height: auto;
            position: absolute;
            left: 5px; /* Makin mepet ke kiri */
            top: 50px; /* Lebih turun lagi */
        }
        .title {
            font-size: 16pt;
            font-weight: bold;
            text-decoration: underline;
        }
        .content {
            margin-top: 15px; /* Dikurangi agar lebih padat */
            line-height: 1.5; /* Sedikit lebih rapat */
        }
        .footer {
            margin-top: 20px; /* Dikurangi agar tidak membuat halaman baru */
            text-align: right;
        }
        .signature {
            margin-top: 70px; /* Dikurangi agar tidak terpotong */
            text-align: right; /* Tanda tangan dipindah ke kanan */
        }
        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('image/sabiru.png') }}" class="logo">
        <h2>PT. Samudra Biru Development</h2>
        <p>Jl. Raya Sukahati Jl. Raya Karadenan, Sukahati, Kec. Cibinong</p>
        <p>Kabupaten Bogor, Jawa Barat, Indonesia</p>
        <p>Email: samudrabirudevelop@gmail.com | Telepon: 0822 4269 8548</p>
        <hr>
    </div>

    <!-- Judul Surat -->
    <div class="title" style="text-align: center; margin-top: 15px;">
        SURAT PENGAJUAN IZIN
    </div>

    <!-- Isi Surat -->
    <div class="content">
        <p>Kepada Yth,</p>
        <p><strong>Manajer HRD</strong></p>
        <p>PT. Samudra Biru Development</p>
        <p>Di Tempat</p>

        <p>Dengan hormat,</p>
        <p>Yang bertanda tangan di bawah ini:</p>

        <table style="width: 100%; margin-top: 5px;">
            <tr>
                <td style="width: 30%;">Nama</td>
                <td>: {{ $izins->first()->karyawan->nama }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: {{ $izins->first()->karyawan->role }}</td>
            </tr>
            <tr>
                <td>Tanggal Izin</td>
                <td>: 
                    {{ \Carbon\Carbon::parse($izins->first()->tanggal)->translatedFormat('d F Y') }} - 
                    {{ \Carbon\Carbon::parse($izins->last()->tanggal)->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>Alasan</td>
                <td>: {{ $izins->first()->alasan }}</td>
            </tr>
        </table>

        <p>Saya mengajukan permohonan izin pada tanggal tersebut di atas dikarenakan alasan yang telah saya sebutkan. Saya berharap agar permohonan ini dapat dikabulkan.</p>
        <p>Demikian surat izin ini saya buat dengan sebenar-benarnya. Atas perhatian dan kebijaksanaan Bapak/Ibu, saya mengucapkan terima kasih.</p>
    </div>

    <!-- Footer & Tanda Tangan -->
    <div class="footer">
        <p>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
    </div>

    <div class="signature">
        <p>Hormat saya,</p>
        <br><br><br>
        <p><strong>{{ $izins->first()->karyawan->nama }}</strong></p>
    </div>

</body>
</html>
