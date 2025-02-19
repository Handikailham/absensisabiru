<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\FromArray;

class RecapAbsen implements FromArray
{
    protected $startDate;
    protected $endDate;

    
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function array(): array
    {
        $result = [];

       
        $tanggal_awal = date('d F Y', strtotime($this->startDate));
    $tanggal_akhir = date('d F Y', strtotime($this->endDate));

        $result[] = ['Recap Absensi Karyawan Samudra Biru Tanggal ' . $tanggal_awal . ' Sampai ' . $tanggal_akhir]; 
        $statuses = ['Hadir', 'Izin', 'Terlambat']; 
        $result[] = array_merge(['Nama Karyawan'], $statuses);

       
        $absens = Absen::with('karyawan')
            ->whereBetween('tanggal', [$this->startDate, $this->endDate])
            ->get();

        
        $grouped = $absens->groupBy(function ($item) {
            return $item->karyawan->id ?? 0;
        });

       
foreach ($grouped as $group) {
    $nama = $group->first()->karyawan->nama ?? 'N/A';
   
    $counts = array_fill_keys($statuses, 0);

    foreach ($group as $record) {
        
        $status = ucfirst(strtolower($record->status ?? 'Hadir'));

        if (in_array($status, $statuses)) {
            $counts[$status]++;
        }
    }

    $result[] = array_merge([$nama], array_values($counts));
}


        
        $result[] = [];

        
        $result[] = ['Detail Absensi Karyawan Samudra Biru Tanggal ' . $tanggal_awal . ' Sampai ' . $tanggal_akhir];       // Judul bagian detail
        
        $result[] = ['ID', 'Tanggal', 'Nama Karyawan', 'Status', 'Alasan', 'Jam Masuk', 'Jam Pulang'];
        foreach ($absens as $absen) {
            $result[] = [
                $absen->id,
                $absen->tanggal,
                $absen->karyawan->nama ?? 'N/A',
                $absen->status ?? 'Hadir',
                $absen->alasan,
                $absen->jam_masuk,
                $absen->jam_pulang,
            ];
        }

        return $result;
    }
}
