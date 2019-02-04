<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class appSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
           [
               'a_id'=>'1',
               's_id'=>null,
               'date'=>new Carbon('2019-02-03 12:00:00'),
           ],
            [
                'a_id'=>'1',
                's_id'=>null,
                'date'=>new Carbon('2019-02-03 16:00:00'),

            ],
            [
                'a_id'=>'1',
                's_id'=>null,
                'date'=>new Carbon('2019-02-03 18:00:00'),
            ]
        ]);
    }
}
