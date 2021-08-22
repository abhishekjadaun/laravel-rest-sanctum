<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userinfos')->insert([
            'name' => 'abhi',
            'email' => 'dummy@dummy.com',
            'password' => Hash::make('password')
        ]);
    }
}
