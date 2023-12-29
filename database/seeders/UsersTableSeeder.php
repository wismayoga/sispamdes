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

        for ($i = 1; $i <= 100; $i++) {

            //php artisan make:seeder PegawaiSeeder

            // insert data ke table pegawai menggunakan Faker
            $prefixes = ['Gede'];
            $randomPrefix = $faker->randomElement($prefixes);
            $fullName = $randomPrefix . ' ' . $faker->name;
            $firstName = explode(' ', $faker->name)[1];

            $generatedEmail = strtolower($firstName) . '@gmail.com';

            // Check if the email is unique
            $isUnique = DB::table('users')->where('email', $generatedEmail)->doesntExist();

            if ($isUnique) {
                // Insert the user with the unique email
                DB::table('users')->insert([
                    'nama'       => $fullName,
                    'email'      => $generatedEmail,
                    'password'   => '$2y$10$zwPC9hM7QKn0iaqXjNkLweE2aH1hxzdQc7HOOoCWrHWRBFkoBpx9u',
                    'role'       => 'Pelanggan',
                    'status'     => 'Aktif',
                    'nomor_hp'   => '+628' . str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT),
                    'alamat'     => 'Desa Kayuputih',
                    'foto_profil' => '',
                ]);
            } else {
                // If email is not unique, skip creating the user and continue the loop
                continue;
            }

            // $pelangganIDs = DB::table('users')->pluck('id');

            // DB::table('pendataans')->insert([
            //     'id_petugas'    => $faker->randomElement($pelangganIDs),
            //     'id_pelanggan'    => $faker->randomElement($pelangganIDs),
            //     'nilai_meteran'    => $faker->numberBetween($min = 10000, $max = 50000),
            //     'foto_meteran'   => '',
            //     'total_harga'          => $faker->numberBetween($min = 10000, $max = 50000),
            //     'status_pembayaran'          => $faker->randomElement($array = array ('Lunas','Tertunggak')),
            // ]);



            // DB::table('pengaduans')->insert([
            //     'id_pelanggan'    => $faker->randomElement($pelangganIDs),
            //     'pengaduan'    => $faker->paragraph,
            //     'status_pengaduan'    => 'Belum Dilihat',
            //     'foto_pengaduan'   => '',
            // ]);
        }
    }
}
