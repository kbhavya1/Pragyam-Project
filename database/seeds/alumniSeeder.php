<?php

use Illuminate\Database\Seeder;

class alumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('alumnis')->insert([
            ['aid'=>'1',
                'slot_id'=>'2',
                's_time'=>'01:00:00',
                'e_time'=>'02:00:00',
                'is_booked'=>"0",
            ],
            ['aid'=>'2',
                'slot_id'=>'2',
            's_time'=>'04:00:00',
            'e_time'=>'05:00:00',
            'is_booked'=>"0",
        ],

            ]);
    }
}
