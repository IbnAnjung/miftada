<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Kelas;
use DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kelas.index');
    }

    public function indexNonAktif()
    {
        return view('pages.kelas.nonaktif');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kelas.form', ['form'=>'create']);
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
            'nama' => ['required', 'min:1', 'max:50'],
            'tingkat' => ['required', 'int', Rule::in([1,2,3,4,5,6,0])]
        ]);

        $kelas = new Kelas;
        $kelas->nama    = $request->input('nama');
        $kelas->tingkat = $request->input('tingkat');

        $kelas->save();

        return redirect()->back()->with('success', 'Tambah Kelas Berhasil');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('pages.kelas.show', ['kelas'=>$kelas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('pages.kelas.form', ['form'=>'edit', 'kelas' => $kelas]);
        
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
            'nama' => ['required', 'min:1', 'max:50'],
            'tingkat' => ['required', 'int', Rule::in([1,2,3,4,5,6,0])]
        ]);

        $kelas = Kelas::findOrFail($id);

        $kelas->nama    = $request->input('nama');
        $kelas->tingkat = $request->input('tingkat');

        $kelas->save();

        return redirect()->back()->with('success', 'Update Kelas Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->siswas()->delete();
        $kelas->delete();

        return response()->json(['status' => true]);
    }

    public function restore($id)
    {

        $kelas = Kelas::onlyTrashed()->findOrFail($id);

        $kelas->siswas()->onlyTrashed()->restore();
        $kelas->restore();

        return response()->json(['status'=> true]);

    }

    public function data()
    {
    
        $kelas = Kelas::all();

        return DataTables::of($kelas)
            ->addColumn('total_siswa', function($kelas){
                $totalSiswa = $kelas->siswas->count();
                return number_format($totalSiswa, 0, ',', '.');                
            })
            ->addColumn('aksi', function($kelas){
                return "
                    <div class='btn-group mb-3' role='group' aria-label='Basic example'>
                        <button type='button' onclick='inactivatingKelasConfirmating(".$kelas->id.")' class='btn btn-danger'><i class='fa fa-trash'></i></button>
                        <a href='".route('kelas.show', ['kela'=>$kelas->id])."' class='btn btn-success'><i class='fa fa-eye'></i></a>
                        <a href='".route('kelas.edit', ['kela'=>$kelas->id])."' class='btn btn-warning'><i class='fa fa-edit'></i></a>
                    </div>
                ";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dataNonAktif()
    {
        $kelas = Kelas::onlyTrashed();

        return DataTables::of($kelas)
            ->addColumn('total_siswa', function($kelas){
                $totalSiswa = $kelas->siswas->count();
                return number_format($totalSiswa, 0, ',', '.');                
            })
            ->addColumn('aksi', function($kelas){
                return "
                    <div class='btn-group mb-3' role='group' aria-label='Basic example'>
                        <button type='button' onclick='restoreKelasConfirmating(".$kelas->id.")' class='btn btn-primary'><i class='fa fa-arrow-left'></i></button>
                        <a href='".route('kelas.show', ['kela'=>$kelas->id])."' class='btn btn-success'><i class='fa fa-eye'></i></a>
                    </div>
                ";
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dataSiswa($idKelas)
    {

        $kelas = Kelas::findOrFail($idKelas);

        $siswas = $kelas->siswas();

        return DataTables::of($siswas)
            ->make(true);

    }
}
