<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            "npm" => "120110210076",
            "name" => "Bagas Jonathan Sitanggang",
            "email" => "bagassitanggang83@gmail.com",
            "phone_number" => "081383028969",
            "departement" => "S1_AKUNTANSI", 
            "password" => Hash::make("sekteikkoikko76"),
            "status" => "MAHASISWA",
            "role" => "admin",
        ]);
    }
}
