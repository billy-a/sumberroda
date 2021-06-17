<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 20; $i++){

    		DB::table('tblbarang')->insert([
    			'namabrg' => $faker->name,
    			'idkategori' => $faker->numberBetween(1,4),
    			'idbrand' => $faker->numberBetween(1,20),
    			'lebarban' => $faker->numberBetween(80,90),
    			'rasioban' => $faker->numberBetween(80,90),
    			'diameterban' => $faker->numberBetween(80,90),                
    			'infoservis' => $faker->text,
    			'detail' => $faker->text,
    			'stok' => $faker->numberBetween(80,90), 
    			'hargabeli' => $faker->numberBetween(200000,300000),
    			'hargajual' => $faker->numberBetween(300001,400001),                
    			'hargajasa' => $faker->numberBetween(50000,100000),
					'gambar' => 'image.png'
    		]);
 
    	}
    }
}
