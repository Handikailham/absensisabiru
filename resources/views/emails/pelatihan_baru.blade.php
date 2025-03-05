<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pemberitahuan Resmi Pelatihan Baru</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .container {
      background-color: #ffffff;
      padding: 20px;
      border: 1px solid #e0e0e0;
      max-width: 600px;
      margin: 0 auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header {
      text-align: center;
      border-bottom: 2px solid #007bff;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    .header h1 {
      color: #007bff;
      margin: 0;
      font-size: 24px;
    }
    .content p {
      line-height: 1.6;
      font-size: 16px;
      margin: 10px 0;
    }
    .content p strong {
      display: inline-block;
      width: 150px;
    }
    .footer {
      text-align: center;
      font-size: 14px;
      color: #777777;
      margin-top: 20px;
      border-top: 1px solid #e0e0e0;
      padding-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Pemberitahuan Resmi Pelatihan Baru</h1>
    </div>
    <div class="content">
      <p><strong>Pelatihan:</strong> {{ $pelatihan->nama_pelatihan }}</p>
      <p><strong>Tanggal Pendaftaran:</strong> {{ \Carbon\Carbon::parse($pelatihan->tanggal_pendaftaran)->isoFormat('D MMMM Y') }}</p>
      <p><strong>Tanggal Pelatihan:</strong> {{ \Carbon\Carbon::parse($pelatihan->tanggal_pelatihan)->isoFormat('D MMMM Y') }}</p>
      <p><strong>Waktu Mulai:</strong> {{ \Carbon\Carbon::parse($pelatihan->waktu_mulai)->format('H:i') }}</p>
      <p><strong>Waktu Akhir:</strong> {{ \Carbon\Carbon::parse($pelatihan->waktu_akhir)->format('H:i') }}</p>
      <p><strong>Alamat:</strong> {{ $pelatihan->alamat }}</p>
      <p><strong>Deskripsi:</strong> {{ $pelatihan->deskripsi }}</p>
    </div>
    <div class="footer">
      <p>Silahkan cek aplikasi untuk info lebih lanjut.</p>
      <p>Terima kasih.</p>
    </div>
  </div>
</body>
</html>
