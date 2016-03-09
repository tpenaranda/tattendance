<?php

use Illuminate\Database\Seeder;

class GuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guestsNames = [
            'Davis', 'Daniela', 'Daysi', 'Walter', 'Maybelle', 'Maris',
            'Clara', 'Bobby', 'Ollie', 'Marcelle', 'Joe', 'Hyacinth', 'Annis',
            'Yee', 'Malinda', 'Raphael', 'Jorge', 'Jerri', 'Coletta', 'Catrice',
        ];

        $randomizeData = true; // set to false for a real event.

        foreach ($guestsNames as $guestName) {
            DB::table('guests')->insert([
                'name' => $guestName,
                'token' => str_random(24),
                'going' => $randomizeData ? rand(0, 1) : 0,
                'need_a_ride' => $randomizeData ? rand(0, 1) : 0,
                'notified' => $randomizeData ? rand(0, 1) : 0
            ]);
        }
    }
}
