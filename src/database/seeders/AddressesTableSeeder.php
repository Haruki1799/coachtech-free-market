<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'user_name' => "テストユーザー",
            'post_code' => '123-4567',
            'address' => "東京都新宿1-2-3",
            'building' => 'test102',
            'profile_image' => '/Users/kobayashiharuki/coachtech/laravel/coachtech-free-market/profile_image.JPG',
        ];
        DB::table('addresses')->insert($param);
    }
}
