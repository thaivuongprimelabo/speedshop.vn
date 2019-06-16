<?php

use App\Constants\Common;
use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $config = [
            [
                'id' => 1
            ]
        ];
        DB::table(Common::CONFIG)->delete();
        DB::table(Common::CONFIG)->insert($config);
    }
}
