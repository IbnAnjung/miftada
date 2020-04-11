<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BayarTagihanSiswa;
use App\TagihanSiswa;
use App\Siswa;
use App\Tagihan;
use DataTables;

class BayarTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Display form pembayaran 
     * 
     * @return \Illuminate\Http\Respone
     */
    public function baru()
    {
        return view('pages.tagihan.bayar.baru');
    }

    /**
     * Display a form of the bayar tagihan per siswa
     * 
     * @return \Illuminate\Http\Response
     */
    public function siswa()
    {
        return view('pages.tagihan.bayar.persiswa');
    }

    /**
     * Display a form of the bayar tagihan per tagihan
     * 
     * @return \Illuminate\Http\Response
     */
    public function tagihan()
    {
        return view('pages.tagihan.bayar.pertagihan');
    }
    
    /**
     * Display Rekapan Pembayaran
     * 
     * @return \Illuminate\Http\Response
     */
    public function rekap()
    {
        return view('pages.tagihan.bayar.rekap');
    }

    /**
     * list of permbayaran
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return DataTables
     */
    public function data(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'date|date_format:Y-m-d|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'date|date_format:Y-m-d|after_or_equal:tanggal_awal'
        ]);

        $pembayarans = BayarTagihanSiswa::with([
            'tagihanSiswa' => function($tagihanSiswa){
                $tagihanSiswa->with('tagihan','siswa.kelas');
            },
            'userCreated'
        ])
            ->whereBetween('tanggal', [$request->get('tanggal_awal'), $request->get('tanggal_akhir')]);

        return DataTables::of($pembayarans)
            ->editColumn('total', '{{ number_format($total,2, ".", ",") }}')
            ->addColumn('aksi', function($pembayaran){
                return " 
                    <div class='btn-group'>
                        <a class='btn btn-warning btn-sm rubah' data-id='".$pembayaran->id."' href='#' 
                            onclick='rubahPembayaran(this)' data-total='".$pembayaran->total."'>Rubah</a>
                        <a class='btn btn-danger btn-sm delete' data-id='".$pembayaran->id."' href='#'
                            onclick='hapusPembayaran(this)'>Hapus</a>
                    </div>
                    ";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * total pembayaran 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function total(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'date|date_format:Y-m-d|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'date|date_format:Y-m-d|after_or_equal:tanggal_awal'
        ]);

        $total = BayarTagihanSiswa::whereBetween('tanggal', [$request->get('tanggal_awal'), $request->get('tanggal_akhir')])
            ->sum('total');

        return response()->json(['total'=> number_format($total, 2, '.', ',')], 200);
    }

    /**
     * Handle request form pembayaran per siswa per tagihan
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\Response
     */
    public function bayar(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d',
            'tagihan' => 'required',
            'bayar' => 'required'
        ]);
        
        $siswa = Siswa::findOrFail($request->get('siswa'));

        if(!$siswa) return response()->json(['message'=> 'data siswa tidak ketemu'], 404);

        $tagihanSiswa = $siswa->tagihan()->wherePivot('tagihan_id', $request->get('tagihan'))->first();

        if(!$tagihanSiswa) return response()->json(['message'=> 'data tagihan siswa tidak ketemu'], 404);
        
        $totalTagihanSebelumTambah = BayarTagihanSiswa::where('tagihan_siswa_id', $tagihanSiswa->id)->sum('total');
        
        if($totalTagihanSebelumTambah + $request->get('bayar') > $tagihanSiswa->nominal - $tagihanSiswa->pivot->potongan){
            return response()->json(['message' => 'Total pembayaran melebihi tagihan, harap di koreksi'], 400);
        }

        $inputPembayaran = $this->store([
            (object) [
                'id' => $tagihanSiswa->id,
                'tanggal' => $request->get('tanggal'),
                'total' => $request->get('bayar'),
                'siswa' =>  $siswa ,  
            ]
        ]);
        
        if($inputPembayaran->status) {
            return response(200);
        }else{
            return response()->json(['message' => $inputPembayaran->errors[0]->pesan . " " . $inputPembayaran->errors[0]->siswa], 400); 
        }
    }


    /**
     * store bayar 
     * 
     * @return Illuminate\Http\Response
     * 
     */
    public function store(array $tagihans)
    {
        $status = true;
        $errors = [];

        foreach($tagihans as $tagihan){

            try{
                $bayarTagihan = new BayarTagihanSiswa;
                $bayarTagihan->tagihan_siswa_id = $tagihan->id;
                $bayarTagihan->tanggal = $tagihan->tanggal;
                $bayarTagihan->total = $tagihan->total;
                $bayarTagihan->save();
            }catch(\Exception $e){
                $status = false;
                $errors[] = (object) [
                    'pesan' => $e->getMessage(),
                    'siswa' => $tagihan->siswa->nama
                ]; 
            }

        }

        return (object) [
            'status' => $status,
            'errors' => $errors
        ];

    }

    /**
     * function to rubah nominal pembayaran
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\Respons
     */
    public function rubahBayar(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|integer'
        ]);

        $pembayaran = BayarTagihanSiswa::with('tagihanSiswa.tagihan')->findOrFail($id);

        $totalTagihanSebelumRubah = bayarTagihanSiswa::where('tagihan_siswa_id', $pembayaran->tagihan_siswa_id)->sum('total');
        
        if($totalTagihanSebelumRubah - $pembayaran->total + $request->get('nominal' ) > $pembayaran->tagihanSiswa->tagihan->nominal - $pembayaran->tagihanSiswa->potongan){
            return response()->json(['message'=> 'Total pembayaran melebihi nominal tagihan'], 400);
        }

        $pembayaran->total = $request->get('nominal');
        $pembayaran->save();

        return response(200);
    }

    
    /**
     * functoin to hapus pembayaran 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function hapusBayar(Request $request, $id)
    {
        $pembayaran = BayarTagihanSiswa::findOrFail($id);

        $pembayaran->delete();

        return response(200);
    }

}
