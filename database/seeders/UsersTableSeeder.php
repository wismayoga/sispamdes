<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 15; $i++) {

            //php artisan make:seeder PegawaiSeeder

            // insert data ke table pegawai menggunakan Faker

            // DB::table('users')->insert([
            //     'nama'    => $faker->name,
            //     'email'    => $faker->name. '@gmail.com',
            //     'password'    => bcrypt('secret'),
            //     'role'   => 'Petugas',
            //     'status'          => 'Aktif',
            //     'nomor_hp'          => $faker->e164PhoneNumber,
            //     'alamat'          => $faker->address,
            //     'foto_profil'          => '',
            // ]);

            $pelangganIDs = DB::table('users')->pluck('id');

            DB::table('pendataans')->insert([
                'id_petugas'    => $faker->randomElement($pelangganIDs),
                'id_pelanggan'    => $faker->randomElement($pelangganIDs),
                'nilai_meteran'    => $faker->numberBetween($min = 10000, $max = 50000),
                'foto_meteran'   => '',
                'total_harga'          => $faker->numberBetween($min = 10000, $max = 50000),
                'status_pembayaran'          => $faker->randomElement($array = array ('Lunas','Tertunggak')),
            ]);

            

            // DB::table('pengaduans')->insert([
            //     'id_pelanggan'    => $faker->randomElement($pelangganIDs),
            //     'pengaduan'    => $faker->paragraph,
            //     'status_pengaduan'    => 'Belum Dilihat',
            //     'foto_pengaduan'   => '',
            // ]);
        }
    }
}
