<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminKunjunganController extends Controller
{
    public function kunjungans()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();

        $user = Auth::user();
        $kunjungans = Kunjungan::all();

        return view('kunjungan',compact('user','kunjungans','pasiens','dokters'));
    }

    // TAMBAH DATA KUNJUNGAN
    public function submit_kunjungan(Request $req)
    {
        $validate = $req->validate([
            'pasiens_id' => 'required',
            'dokters_id' => 'required',
            'keterangan' => 'required',
        ]);

        $kunjungan = new Kunjungan;
        $kunjungan->pasiens_id = $req->get('pasiens_id');
        $kunjungan->dokters_id = $req->get('dokters_id');
        $kunjungan->keterangan = $req->get('keterangan');

        $kunjungan->save();
        $notification = array(
            'message' => 'Data kunjungan berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kunjungans')->with($notification);
    }

    // AJAX PROCESS
    public function getDataKunjungan($id)
    {
        $kunjungan = Kunjungan::find($id);
        return response()->json($kunjungan);
    }

    // UPADATE DATA KUNJUNGAN
    public function update_kunjungan(Request $req) 
    {
        $kunjungan = Kunjungan::find($req->get('id'));

        $validate = $req->validate([
            'keterangan' => 'required',
        ]);

        $kunjungan->keterangan = $req->get('keterangan');

        $kunjungan->save();

        $notification = array(
            'message' => 'Data Kunjungan berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kunjungans')->with($notification);

    }

    // DELETE DATA KUNJUNGAN
    public function delete_kunjungan($id)
    {
        $kunjungan = Kunjungan::find($id);

        $kunjungan->delete();

        $success = true;
        $message = "Data Kunjungan berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

}
