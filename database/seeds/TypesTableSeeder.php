<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['name' => 'Youtube Like'],
            ['name' => 'Youtube Comment'],
        ];

        foreach ($type as $t) {
            \App\Models\TypeTask::create($t);
        }
    }
}
