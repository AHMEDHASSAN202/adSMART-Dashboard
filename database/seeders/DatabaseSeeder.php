<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(AuthTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(FlagSeeder::class);
    }
}
