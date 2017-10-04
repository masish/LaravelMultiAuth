<?php

use Illuminate\Database\Seeder;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('players')->insert([
        [
            'name' => 'ダビド・ デ・ヘア',
            'number' => '1',
            'club' => 1,
            'position' => 0,
            'created_at' => '2017-05-02 14:28:19',
            'updated_at' => '2017-05-02 14:28:19'
        ],[
            'name' => 'ビクトル・ リンデロフ',
            'number' => '2',
            'club' => 1,
            'position' => 1,
            'created_at' => '2017-05-02 14:28:19',
            'updated_at' => '2017-05-02 14:28:19'
        ]
      ]);
    }
}
