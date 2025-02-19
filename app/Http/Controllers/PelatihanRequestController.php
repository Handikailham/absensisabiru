<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PelatihanRequest;
use Illuminate\Http\Request;

class PelatihanRequestController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan status dari query parameter, default 'pending'
        $status = $request->query('status', 'pending');

        // Ambil request sesuai dengan status yang diinginkan
        $requests = PelatihanRequest::with('pelatihan', 'karyawan')
            ->where('status', $status)
            ->get();

        return view('pelatihanrequest.index', compact('requests', 'status'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,declined',
        ]);

        $pelatihanRequest = PelatihanRequest::findOrFail($id);
        $pelatihanRequest->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status permintaan pelatihan berhasil diperbarui.');
    }
}
