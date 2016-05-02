<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$status = [
    		['name' => 'Avaiable'],
    		['name' => 'In progress'],
            ['name' => 'Uncompleted'],
            ['name' => 'Complete'],
    		['name' => 'Penalty']
    	];

    	foreach($status as $s) {
    		\App\Models\StatusTask::create($s);
    	}
    }
}
