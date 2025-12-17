<?php

namespace App\Http\Controllers;

use App\Models\LembarDisposisi;
use App\Models\LembarDisposisiApproval;
use App\Models\MasterBarang;
use App\Models\MasterDepartemen;
use App\Models\MasterJabatan;
use App\Models\PengajuanItem;
use App\Models\PengajuanPembelian;
use App\Models\User;
use Illuminate\Http\Request;

class LembarDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($idPengajuan, $idPengajuanItem)
    {
        $idPengajuan = decrypt($idPengajuan);
        $idPengajuanItem = decrypt($idPengajuanItem);
        $getNamaBarang = PengajuanItem::with('getBarang')->where('id', $idPengajuanItem)->first();
        $data = PengajuanItem::with([
            'getRekomendasi.getRekomedasiDetail' => function ($query) {
                $query->where('Rekomendasi', 1)->with('getNamaVendor');
            },
            'getBarang',
            'getPengajuanPembelian.getPermintaan.getDetail' => function ($query) use ($getNamaBarang) {
                $query->where('NamaBarang', $getNamaBarang->IdBarang);
            },
            'getPengajuanPembelian.getPermintaan.getDiajukanOleh'
        ])->where('id', $idPengajuanItem)->first();
        $user = User::where('kodeperusahaan', auth()->user()->kodeperusahaan)->get();
        $jabatan = MasterJabatan::get();
        $departemen = MasterDepartemen::get();
        // dd($data);
        return view('lembar-disposisi.create', compact('data', 'user', 'jabatan', 'departemen', 'idPengajuan', 'idPengajuanItem'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedHeader = $request->validate([
            'NamaBarang' => 'required|string',
            'IdPengajuan' => 'required',
            'PengajuanItemId' => 'required',
            'Harga' => 'required|string',
            'RencanaVendor' => 'required|string',
            'TujuanPenempatan' => 'required|string',
            'FormPermintaan' => 'required|string',
        ]);

        // Simpan Header (LembarDisposisi sebagai header)
        $lembarDisposisi = LembarDisposisi::create([
            'IdPengajuan' => $validatedHeader['IdPengajuan'],
            'PengajuanItemId' => $validatedHeader['PengajuanItemId'],
            'NamaBarang' => $validatedHeader['NamaBarang'],
            'Harga' => $validatedHeader['Harga'],
            'RencanaVendor' => $validatedHeader['RencanaVendor'],
            'TujuanPenempatan' => $validatedHeader['TujuanPenempatan'],
            'FormPermintaan' => $validatedHeader['FormPermintaan'],
        ]);


        if ($request->has('IdUser') && is_array($request->IdUser)) {
            foreach ($request->IdUser as $i => $idUser) {
                if (!$idUser) {
                    continue;
                }
                LembarDisposisiApproval::create([
                    'IdLembarDisposisi' => $lembarDisposisi->id,
                    'IdUser' => $idUser,
                    'Nama' => $request->input('Nama')[$i] ?? null,
                    'Jabatan' => $request->input('Jabatan')[$i] ?? null,
                    'Departemen' => $request->input('Departemen')[$i] ?? null,
                    'Justifikasi' => $request->input('Justifikasi')[$i] ?? null,
                    'Status' => 'N',
                    'UserCreate' => auth()->user()->id ?? null,
                ]);
            }
        }

        return redirect()->route('lembar-disposisi.index')->with('success', 'Lembar Disposisi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($idPengajuan, $idPengajuanItem)
    {
        // $idPengajuan = decrypt($idPengajuan);
        // $idPengajuanItem = decrypt($idPengajuanItem);
        $data = LembarDisposisi::with('getDetail')->where('IdPengajuan', $idPengajuan)->where('PengajuanItemId', $idPengajuanItem)->first();
        dd($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LembarDisposisi $lembarDisposisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LembarDisposisi $lembarDisposisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LembarDisposisi $lembarDisposisi)
    {
        //
    }
}
