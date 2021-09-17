<?php

namespace App\Http\Controllers;

use App\Barang;
use App\PermintaanDetail;
use App\PermintaanHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PermintaanHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perpage ? $request->perpage : 10 ;
        $data = PermintaanHeader::with(['pegawai','details']);
        if (request()->q != '') {
            $outlets = $data->where('no_transaksi', 'LIKE', '%' . request()->q . '%');
        }
        $data = $data->orderBy('created_at','desc')->paginate($perPage);
        return Response::json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $string = date('ymd');
            $noTransaksi = $string."".rand();
            $tanggal = date('Y-m-d', strtotime($request->tanggal));

            $validator = Validator::make($request->all(), [
                'pegawai_id' => 'required|exists:pegawais,id',
                'tanggal' => 'required',
                'detail' => 'required'
            ],[
                'pegawai_id.required' => 'Nik wajib di pilih',
                'pegawai_id.exists' => 'Pegawai tidak terdaftar',
                'tanggal.required' => 'Tanggal wajib di isi',
                'detail.required' => 'Barang wajib di tambah'
            ]);

            if ($validator->fails()) {
                return Response::json([
                    'message' => 'Gagal',
                    'code' => 'error',
                    'errors' => $validator->errors()->jsonSerialize()
                ]);
            }

            $permintaanHeader = PermintaanHeader::create([
                'no_transaksi' => $noTransaksi,
                'pegawai_id' => $request->pegawai_id,
                'tanggal' => $tanggal
            ]);

            if ($request->has('detail')) {
                foreach ($request->detail as $row) {
                    $barang = Barang::find($row['barang_id']);

                    if ($row['qty'] == "") {
                        throw new \Exception('Kuantiti tidak boleh kosong');
                    }

                    if ($row['qty'] > $barang->stok || $barang->stok == 0) {
                        throw new \Exception('Stok untuk '. $row['barang_data_id']['nama']. " tidak tersedia");
                    }

                    PermintaanDetail::create([
                        'permintaan_header_id' => $permintaanHeader->id ?? 0,
                        'barang_id' => (int)$row['barang_id'],
                        'qty' => (int)$row['qty'],
                        'keterangan' => $row['keterangan'] ?? '-'
                    ]);

                    $barang = Barang::find($row['barang_id']);
                    $total = ($barang->stok - $row['qty']);
                    $barang->stok = $total;
                    $barang->save();
                }
            }

            DB::commit();

            return Response::json([
                'message' => 'Berhasil',
                'code' => 'success'
            ]);
        } catch (\Throwable $throwable) {
            DB::rollback();
            return Response::json([
                'message' => 'Gagal, '. $throwable->getMessage(),
                'code' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PermintaanHeader  $permintaanHeader
     * @return \Illuminate\Http\Response
     */
    public function show(PermintaanHeader $permintaanHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermintaanHeader  $permintaanHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(PermintaanHeader $permintaanHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PermintaanHeader  $permintaanHeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermintaanHeader $permintaanHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PermintaanHeader  $permintaanHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermintaanHeader $permintaanHeader)
    {
        //
    }
}
