<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            $faker = Faker::create();
            DB::table('booking')->insert([
                'email' => $faker->email(),
                'token' => md5(uniqid(true)),
                'date' => $faker->dateTimeBetween('now', '+30years')->format('Y-m-d H:') . "00:00",
                'created_at' => Carbon::now()->addHour(1)
            ]);
        }
    }
}
