<?php

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Barang::create([
            'kode' => 'XXX-XXX-001',
            'nama' => 'AMPLOP A COKLAT',
            'lokasi' => 'L1-R1A',
            'stok' => '23',
            'satuan' => 'PAK',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-002',
            'nama' => 'AMPLOP B COKLAT',
            'lokasi' => 'L1-R1B',
            'stok' => '35',
            'satuan' => 'PAK',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-006',
            'nama' => 'AMPLOP B COKLAT',
            'lokasi' => 'L1-R1B',
            'stok' => '35',
            'satuan' => 'PAK',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-003',
            'nama' => 'PENSIL TINTA HIJAU',
            'lokasi' => 'L1-G1B',
            'stok' => '50',
            'satuan' => 'PCS',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-004',
            'nama' => 'PENGGARIS 30 CM',
            'lokasi' => 'L1-IT2B',
            'stok' => '150',
            'satuan' => 'PCS',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-009',
            'nama' => 'KERTAS A4',
            'lokasi' => 'L1-IT3B',
            'stok' => '150',
            'satuan' => 'RIM',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-008',
            'nama' => 'LAPTOP ASUS XXX-A029',
            'lokasi' => 'L1-IT5B',
            'stok' => '150',
            'satuan' => 'BOX',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-007',
            'nama' => 'MAP BIRU',
            'lokasi' => 'L2-TT5B',
            'stok' => '250',
            'satuan' => 'PCS',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-006',
            'nama' => 'PENGHAPUS WHITE BOR',
            'lokasi' => 'L2-TI2B',
            'stok' => '50',
            'satuan' => 'PCS',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);

        \App\Barang::create([
            'kode' => 'XXX-XXX-006',
            'nama' => 'MATERAI 10000 ',
            'lokasi' => 'L2-TI2B',
            'stok' => '150',
            'satuan' => 'PCS',
            'status' => '<i class="badge badge-success">Terpenuhi</i>'
        ]);
    }
}
