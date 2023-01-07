<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    // VIEW DATA PEMBAYARAN
    public function pembayarans()
    {
        $pembayarans = Pembayaran::all();
        $kunjungans = Kunjungan::all();

        return view('pembayaran',compact('pembayarans','kunjungans'));
    }

    // TAMBAH DATA PEMBAYARAN
    public function submit_pembayaran(Request $req)
    {
        $validate = $req->validate([
            'kunjungans_id' => 'required',
            'noRek' => 'required',
            'jmlPembayaran' => 'required',
        ]);

        $pembayaran = new Pembayaran;
        $pembayaran->kunjungans_id = $req->get('kunjungans_id');
        $pembayaran->noRek = $req->get('noRek');
        $pembayaran->jmlPembayaran = $req->get('jmlPembayaran');

        $pembayaran->save();
        $notification = array(
            'message' => 'Data pembayaran berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pembayarans')->with($notification);
    }

    // AJAX PROCESS
    public function getDataPembayaran($id)
    {
        $pembayaran = Pembayaran::find($id);
        return response()->json($pembayaran);
    }

    // UPADATE DATA PASIEN
    public function update_pembayaran(Request $req) 
    {
        $pembayaran = Pembayaran::find($req->get('id'));

        $validate = $req->validate([
            'noRek' => 'required',
            'jmlPembayaran' => 'required',
        ]);

        $pembayaran->noRek = $req->get('noRek');
        $pembayaran->jmlPembayaran = $req->get('jmlPembayaran');

        $pembayaran->save();

        $notification = array(
            'message' => 'Data Pembayaran berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pembayarans')->with($notification);
    }

    // DELETE DATA KUNJUNGAN
    public function delete_pembayaran($id)
    {
        $kunjungan = Pembayaran::find($id);

        $kunjungan->delete();

        $success = true;
        $message = "Data Pembayaran berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
