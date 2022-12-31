<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDokterController extends Controller
{
    // VIEW DATA DOKTER
    public function dokters()
    {
        $user = Auth::user();
        $dokters = Dokter::all();
        return view('dokter',compact('user','dokters'));
    }

    // TAMBAH DATA DOKTER
    public function submit_dokter(Request $req)
    {
        $validate = $req->validate([
            'nama' => 'required',
            'spesialis' => 'required'
        ]);

        $dokter = new Dokter;
        $dokter->nama = $req->get('nama');
        $dokter->spesialis = $req->get('spesialis');

        $dokter->save();
        $notification = array(
            'message' => 'Data pasien berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dokters')->with($notification);
    }

    // AJAX PROCESS
    public function getDataDokter($id)
    {
        $dokter = Dokter::find($id);
        return response()->json($dokter);
    }

     // UPADATE DATA PASIEN
    public function update_dokter(Request $req) 
    {
        $dokter = Dokter::find($req->get('id'));

        $validate = $req->validate([
            'nama' => 'required',
            'spesialis' => 'required',
        ]);

        $dokter->nama = $req->get('nama');
        $dokter->spesialis = $req->get('spesialis');

        $dokter->save();

        $notification = array(
            'message' => 'Data Dokter berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dokters')->with($notification);
    }

    // DELETE DATA DOKTER
    public function delete_dokter($id)
    {
        $dokter = Dokter::find($id);

        $dokter->delete();

        $success = true;
        $message = "Data dokter berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    
}
