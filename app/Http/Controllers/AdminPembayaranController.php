<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Excel;
use PDF;

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
            'buktiPembayaran' => 'required',
        ]);

        $pembayaran = new Pembayaran;
        $pembayaran->kunjungans_id = $req->get('kunjungans_id');
        $pembayaran->noRek = $req->get('noRek');
        $pembayaran->jmlPembayaran = $req->get('jmlPembayaran');
        if($req->hasFile('buktiPembayaran')){
            $extension = $req->file('buktiPembayaran')->extension();

            $filename = 'bkt_bayar'.time().'.'. $extension;

            $req->file('buktiPembayaran')->storeAs('public/bkt_bayar', $filename);

            $pembayaran->buktiPembayaran = $filename;
        }
        $pembayaran->status = $req->get('status');

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
            'status' => 'required',
        ]);

        $pembayaran->noRek = $req->get('noRek');
        $pembayaran->jmlPembayaran = $req->get('jmlPembayaran');
        if ($req->hasFile('buktiPembayaran')) {
            $extension = $req->file('buktiPembayaran')->extension(); 
            $filename = 'bkt_bayar_'.time().'.'.$extension;
            $req->file('buktiPembayaran')->storeAs('public/bkt_bayar', $filename ); 
            
            Storage::delete('public/bkt_bayar/'.$req->get('old_buktiPembayaran')); 
            $pembayaran->buktiPembayaran = $filename; 
        }
        $pembayaran->status = $req->get('status');

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
    
    public function export()
    {
        return Excel::download(new PembayaranExport, 'Pembayarans.xlsx');
    }

    public function pdf_pembayaran()
    {
        $pembayarans = Pembayaran::all();
        $pdf = PDF::loadView('pdfAllPembayaran',['pembayarans' => $pembayarans] );
        return $pdf->download('data-pemabayarans.pdf');
    }
}
