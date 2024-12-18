<?php

use Illuminate\Database\Seeder;
use Database\Seeds\ClientesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(ClientesSeeder::class);
    }
}
