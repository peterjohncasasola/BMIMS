<?php

use Illuminate\Database\Seeder;

class BlottersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Blotter', 100)->create();
    }
}
