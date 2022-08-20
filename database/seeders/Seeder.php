<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Support\Facades\DB;

class Seeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'level' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'user',
                'level' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);

        $randStr = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randStr = substr(str_shuffle($randStr), 0, 12);
        DB::table('users')->insert([
            [
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234'),
                'role_id' => '1',
                'code' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('1234'),
                'role_id' => '2',
                'code' => $randStr,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'user 2',
                'email' => 'user2@user2.com',
                'password' => bcrypt('1234'),
                'role_id' => '2',
                'code' => $randStr.'1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);

        DB::table('locations')->insert([
            [
                'country_name' => 'North Carolina',
                'city_name' => 'Wilmington',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "country_name" => "Oregon",
                "city_name" => "Portland",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "country_name" => "Canada",
                "city_name" => "Toronto",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "country_name" => "Polsha",
                "city_name" => "Warsaw",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "country_name" => "Ispaniya",
                "city_name" => "Valencia",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "country_name" => "China",
                "city_name" => "Shanghai",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
        ]);

        $room = [];

        foreach(range(1, 18) as $index) {
            $room[] = [
                'name' => 'Room ' . $index,
                'location_id' => rand(1, 6),
                'temperature' => rand(0, 5),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('rooms')->insert($room);

        $blocks = [];
        foreach(range(1, 90) as $index) {
            $blocks[] = [
                'name' => 'Block ' . $index,
                'price' => rand(200, 500),
                'width' => rand(1, 1),
                'height' => rand(1, 1),
                'length' => rand(2, 2),
                'room_id' => rand(1, 18),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('blocks')->insert($blocks);

        $fridges = [];

        foreach(range(1, 90) as $index) {
            $fridges[] = [
                'name' => 'Fridge ' . $index,
                'block_id' => $index,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('fridges')->insert($fridges);

    }
}
