<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            'name' => 'Bolivar'
        ]);
        DB::table('buses')->insert([
            'name' => 'Dorado'
        ]);
        DB::table('buses')->insert([
            'name' => 'Copacabana'
        ]);
    }
}
