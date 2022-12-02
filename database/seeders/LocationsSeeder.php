<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Botble\Location\Models\City;
use Botble\Location\Models\State;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            State::create([
                'id'      => $provinceRow['province_id'],
                'name'          => $provinceRow['province'],
                'state_id'      => $provinceRow['province_id'],
                'country_id'    => 1,
                'order'         => 0,
                'is_default'    => 1,
                'status'        => 'published'
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'id'       => $cityRow['city_id'],
                    'name'          => $cityRow['city_name'],
                    'city_id'       => $cityRow['city_id'],
                    'state_id'      => $provinceRow['province_id'],
                    'country_id'    => 1,
                    'order'         => 0,
                    'is_default'    => 1,
                    'status'        => 'published'
                ]);
            }
        }
    }
}
