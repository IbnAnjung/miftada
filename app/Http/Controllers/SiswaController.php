<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Siswa;
use App\StatusSiswa;
use App\Kelas;
use DataTables;
use DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statusSiswa = StatusSiswa::all();

        return view('pages.siswa.index', ['statusSiswa'=> $statusSiswa, 'nonaktif' => ($request->get('nonaktif') ? true : false)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.siswa.create', ['url'=>route('siswa.store'), '_method' => 'POST', 'title' => 'Tambah']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa|max:15',
            'nama' => 'required|max:25',
            'kelas' => ['required', Rule::in(Kelas::pluck('id'))],
            'status' => ['required', Rule::in(Status::pluck('id'))]
        ]);
        

        $siswa = new Siswa;
        $siswa->nama = strtoupper($request->input('nama'));
        $siswa->nis = $request->input('nis');
        $siswa->kelas_id = $request->input('kelas');
        $siswa->status_siswa_id = $request->input('status');
        $siswa->save();

        return redirect()->route('siswa.create')->with('success', "Berhasil Menambahkan Data Siswa");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::withTrashed()->with('status', 'kelas')->findOrFail($id);

        return view('pages.siswa.show', ['siswa'=>$siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('pages.siswa.create', ['siswa'=> $siswa, 'url'=>route('siswa.update',['siswa'=>$id]), '_method'=> 'PUT', 'title' => 'Rubah']);
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
        $request->validate([
            'nis' => 'required|max:15',
            'nama' => 'required|max:25',
            'kelas' => ['required', Rule::in(Kelas::pluck('id'))],
            'status' => ['required', Rule::in(StatusSiswa::pluck('id'))]
        ]);
        

        $siswa = Siswa::findOrFail($id);
        $siswa->nama = strtoupper($request->input('nama'));
        $siswa->nis = $request->input('nis');
        $siswa->kelas_id = $request->input('kelas');
        $siswa->status_siswa_id = $request->input('status');
        $siswa->save();

        return redirect()->route('siswa.edit', ['siswa' => $id])->with('success', "Berhasil Menambahkan Data Siswa");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return response(200);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);

        $siswa->restore();

        return response(200);
    }

    /**
     * show data siswa
     * @param \Illuminate\Http\Request $request
     * @return DataTable
     */
    public function data(Request $request)
    {

        $siswas = Siswa::with('status','kelas')
            ->when($request->get('nonaktif'), function($siswa){
                $siswa->onlyTrashed();
            });
        
        return DataTables::of($siswas)
            ->addColumn('aksi', function($siswa) use ($request){
                if($request->get('nonaktif')){
                    return "
                    <div class='btn-group'>
                        <button class='btn btn-warning' onclick='restoreSiswa(".$siswa->id.")' >Restore</button>
                        <a class='btn btn-success' href='".route('siswa.show', ['siswa'=>$siswa->id])."'>Lihat</a>
                    </div>
                ";
                }else{
                    return "
                        <div class='btn-group'>
                            <a class='btn btn-primary' href='".route('siswa.edit', ['siswa'=>$siswa->id])."'>Rubah</a>
                            <a class='btn btn-success' href='".route('siswa.show', ['siswa'=>$siswa->id])."'>Lihat</a>
                            <button class='btn btn-danger' onclick='deleteSiswa(".$siswa->id.")' >Hapus</button>
                        </div>
                    ";
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * show data tagihan per siswa
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\Response JSON
     */
    public function tagihans(Request $request, $id)
    {   
        /**
         * status pembayaran request
         * 0 => belum lunas
         * 1 => sudah lunas
         */
        $request->validate([
            'status_tagihan' => [
                Rule::in([0,1]),
                'integer'
            ],
            'q' => 'max:50'
        ]);
        return  Siswa::with([
            'tagihan' => function($tagihan) use($request) {
                $tagihan->when($request->get('status_tagihan') == 0  , function($tagihan) use($request) {
                    $tagihan->where('nominal', '>', DB::Raw('potongan + bayar'));
                })
                ->when($request->get('status_tagihan') == 1  , function($tagihan) use($request) {
                    $tagihan->where('nominal', '=', DB::Raw('potongan + bayar'));
                })
                ->when($request->get('q'), function($tagihan) use($request){
                    $tagihan->where('keterangan', 'like', '%'.$request->get('q').'%');
                });
            }
        ])->findOrFail($id);
        
    }
}
