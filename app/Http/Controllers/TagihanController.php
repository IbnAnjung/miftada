<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Kelas;
use App\Siswa;
use App\Tagihan;
use App\StatusSiswa;
use DataTables;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tagihan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tagihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $daftarKelasId = Kelas::pluck('id');

        $request->validate([
            'nominal' => 'required|integer',
            'kelas.*' => [
                'required', Rule::in($daftarKelasId)
            ],
            'tanggal' => 'required|date|date_format:Y-m-d',
            'keterangan' => 'required|max:50'
        ]);
        
        $tagihan = new Tagihan;
        $tagihan->tanggal_terbit = $request->input('tanggal');
        $tagihan->keterangan = strtoupper($request->input('keterangan'));
        $tagihan->nominal = $request->input('nominal');

        $tagihan->save();

        $tagihan->siswas()->attach(Siswa::whereIn('kelas_id', $daftarKelasId)->pluck('id'));

        return redirect()->route('tagihan.create')->with('success', 'Berhasil Menambah Tagihan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tagihan = Tagihan::findOrFail($id);

        return view('pages.tagihan.lihat', ['tagihan'=>$tagihan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tagihan = Tagihan::findOrFail($id);

        return view('pages.tagihan.edit', ['tagihan' => $tagihan]);
    }

    /**
     * Show the form for editing potongan tagihan
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function potongan($id)
    {

        $tagihan = Tagihan::findOrFail($id);

        return view('pages.tagihan.potongan', ['tagihan'=>$tagihan]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $request->validate([
            'keterangan' => 'required|min:3',
            'nominal' => 'required|int',
            'tanggal' => 'required|date|date_format:Y-m-d'
        ]);

        $tagihanTerbayar = $tagihan->siswas()->wherePivot('bayar', '>', 0)->first();
        
        if($tagihanTerbayar && $tagihan->nominal != $request->input('nominal')){
            return redirect()->route('tagihan.edit', ['tagihan'=> $id])->withInput()->with("error", "Sudah Ada Siswa Yang Bayar, Nominal Tidak Bisa Di Rubah");
        }

        $tagihan->keterangan = $request->input('keterangan');
        $tagihan->nominal = $request->input('nominal');
        $tagihan->tanggal_terbit = $request->input('tanggal');
        $tagihan->save();

        return redirect()->route('tagihan.edit', ['tagihan' => $id])->with('success', 'Berhasil Merubah Tagihan');
    }

    /**
     * tambah potongan tagihan per siswa
     * @param \Illumnate\Http\Request
     * @param int $id 
     * @return \Illuminate\Http\Response;
     */
    public function rubahPotonganPerSiswa(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $daftarSiswa = Siswa::pluck('id');
        
        $request->validate([
            'siswa.*' =>[
                'required',
                Rule::in($daftarSiswa)
            ],
            'nominal' => 'required|int'
        ]);

        foreach($request->input('siswa') as $idSiswa){
            $siswa = Siswa::find($idSiswa);

            $siswa->tagihan()->updateExistingPivot($tagihan->id, ['potongan'=> $request->input('nominal')]);
        }

        return response(200);

    }

    /**
     * tambah potongan tagihan per statu siswa
     * @param \Illumnate\Http\Request
     * @param int $id 
     * @return \Illuminate\Http\Response;
     */
    public function rubahPotonganPerStatusSiswa(Request $request, $id)
    {

        $tagihan = Tagihan::findOrFail($id);
        $daftarStatusSiswa = StatusSiswa::pluck('id');

        $request->validate([
            'status.*' => [
                'required', Rule::in($daftarStatusSiswa)
            ] 
        ]);

        return response(200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * datatable of tagihan
     * @return DataTables
     */
    public function data()
    {
        $tagihan = Tagihan::with('siswas')->orderBy('tanggal_terbit', 'desc');

        return DataTables::of($tagihan)
            ->addIndexColumn()
            ->editColumn('nominal', '{{ number_format($nominal, 0, ",", ".") }}')
            ->addColumn('total_tagihan', function($tagihan){
                $totalSiswa = $tagihan->siswas->count();
                $totalTagihan = $totalSiswa * $tagihan->nominal;
                $totalPotongan = $tagihan->siswas->sum('pivot.potongan');

                return number_format($totalTagihan - $totalPotongan, 0, ',', '.');
            })
            ->addColumn('total_bayar', function($tagihan){
                $totalTagihan = $tagihan->siswas->sum('pivot.bayar');

                return number_format($totalTagihan, 0, ',', '.');
            })
            ->addColumn('aksi', function($tagihan){
                return "
                    <div class='btn-group'>
                        <a class='btn btn-primary' href='". route('tagihan.show', ['tagihan' => $tagihan->id]) ."'>
                            Lihat
                            </a>
                        <a class='btn btn-success' href='". route('tagihan.edit', ['tagihan' => $tagihan->id]) ."'>
                            Edit
                                </a>
                        <a class='btn btn-warning' href='". route('tagihan.potongan.index', ['tagihan' => $tagihan->id]) ."'>
                            Potongan
                            </a>
                        <a class='btn btn-danger' href='#' data-id='". $tagihan->id ."' onclick='batalkanTagihan(this)'>
                            Batalkan
                            </a>
                    </div>
                ";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * function to handle data tagihan siswa/ dafatar tagihan siswa
     * @param Illuminate\Http\Request $request
     * @param int $id
     * @return DataTables 
     */
    public function dataTagihanSiswa(Request $request, $id)
    {
        $tagihan = Tagihan::find($id);

        if(!$tagihan){
            return response()->json(['data'=>[]]);
        }

        return DataTables::of($tagihan->siswas())
            ->addColumn('edit', function($siswa) use($tagihan){
                return "
                    <a class='btn btn-success btn-sm edit-tagihan-siswa'
                        data-idtagihan='".$tagihan->id."'
                        data-idsiswa='". $siswa->id ."'
                        data-namasiswa='".$siswa->nama."'
                        data-namatagihan='".$tagihan->keterangan."'
                        data-totaltagihan='".number_format($tagihan->nominal, 2 , ',', '.')."'
                        data-potongan='".$siswa->potongan."'
                        href='#'
                    ><i class='fa fa-edit'></i></a>
                ";
            })
            ->rawColumns(['edit'])
            ->make(true);
    }
}
