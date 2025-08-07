<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
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
            'item' => '腕時計',
            'price' => 15000,
            'brand_name' => 'test',
            'explanation' => 'スタイリッシュなデザインのメンズ腕時計',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'condition' => '良好',
            'category_id'=> 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'HDD',
            'price' => 5000,
            'brand_name' => 'test',
            'explanation' => '高速で信頼性の高いハードディスク',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'condition' => '目立った傷や汚れなし',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => '玉ねぎ3束',
            'price' => 300,
            'brand_name' => 'test',
            'explanation' => '新鮮な玉ねぎ3束のセット',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'condition' => 'やや傷や汚れあり',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => '革靴',
            'price' => 4000,
            'brand_name' => 'test',
            'explanation' => 'クラシックなデザインの革靴',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'condition' => '状態が悪い',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'ノートPC',
            'price' => 45000,
            'brand_name' => 'test',
            'explanation' => '高性能なノートパソコン',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'condition' => '良好',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'マイク',
            'price' => 8000,
            'brand_name' => 'test',
            'explanation' => '高音質のレコーディング用マイク',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'condition' => '目立った傷や汚れなし',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'ショルダーバッグ',
            'price' => 3500,
            'brand_name' => 'test',
            'explanation' => 'おしゃれなショルダーバッグ',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'condition' => 'やや傷や汚れあり',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'タンブラー',
            'price' => 500,
            'brand_name' => 'test',
            'explanation' => '使いやすいタンブラー',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'condition' => '状態が悪い',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'コーヒーミル',
            'price' => 4000,
            'brand_name' => 'test',
            'explanation' => '手動のコーヒーミル',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'condition' => '良好',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);

        $param = [
            'user_id' => 1,
            'item' => 'メイクセット',
            'price' => 2500,
            'brand_name' => 'test',
            'explanation' => '便利なメイクアップセット',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            'condition' => '目立った傷や汚れなし',
            'category_id' => 1
        ];
        DB::table('goods')->insert($param);
    }
}
