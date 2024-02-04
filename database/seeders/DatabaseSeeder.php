<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Platform;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'MazBaz',
            'email' => 'mrlog42@gmail.com',
            "password" => "mazbazlabaz",
            "admin" => true,
        ]);

        Platform::create([
           "name" => "Discord",
           "color" => "#0332fc"
        ]);

        Platform::create([
            "name" => "Telegram",
            "color" => "#0393fc"
        ]);

        Status::create([
            "name" => "Opened",
            "color" => "#08fc03"
        ]);

        Status::create([
            "name" => "Closed",
            "color" => "#fc034e"
        ]);
    }
}
