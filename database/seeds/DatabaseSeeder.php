<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => 'Asad',
            'email' => 'Asad@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            ]);
    }
}
