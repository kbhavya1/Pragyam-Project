<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'sid'=>'1',
                'slot_id'=>'1',
                'date'=>Carbon::now(),
                'status'=>'0',

            ],
            [
                'sid'=>'2',
                'slot_id'=>'1',
                'date'=>Carbon::now(),
                'status'=>'0',

            ],
            [
                'sid'=>'3',
                'slot_id'=>'2',
                'date'=>Carbon::now(),
                'status'=>'0',

            ]
        ]);
    }
}
