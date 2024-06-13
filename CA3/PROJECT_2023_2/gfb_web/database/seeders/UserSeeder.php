<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usertypes')->insert([
            'type'     => 'admin',
        ]);
        DB::table('users')->insert([
                'name'     => 'admin',
                'email'    => '12200081.gcit@rub.edu.bt',
                'role'     => 'admin',
                'usertype_id' => 1,
                'password' => bcrypt('Gcit@852351')  //Hash::make('john@123')
        ]); 
    }
}
