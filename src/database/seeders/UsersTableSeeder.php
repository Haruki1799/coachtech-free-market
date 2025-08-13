<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        'id' => 1,
        'name' => 'テストユーザー',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        ];
        DB::table('users')->insert($param);
        $param = [
            'id' => 2,
            'name' => 'テストユーザー2',
            'email' => 'test2@example.com',
            'password' => Hash::make('password'),
        ];
        DB::table('users')->insert($param);
    }
}
