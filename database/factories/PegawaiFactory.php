<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pegawai;
use Faker\Generator as FakerGe;

$factory->define(Pegawai::class, function (FakerGe $fakerGe) {

    $fakerGe->addProvider(new Faker\Provider\fr_FR\Address($fakerGe));
    $fakerGe->addProvider(new Faker\Provider\id_ID\Person($fakerGe));

    return [
        'nik' => $fakerGe->nik(),
        'nama' => $fakerGe->name,
        'departemen' => $fakerGe->departmentName
    ];
});
