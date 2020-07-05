<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class BudgetItemTableSeeder extends Seeder {

    public function run()
    {
        DB::table('work_orders')->insertGetId(
            [
                'uuid' => \Webpatser\Uuid\Uuid::generate(),
                'name' => 'Assistencia domiciliar Reparo',
                'description' => 'Assistencia domiciliar Reparo',
                'plan' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        );
    }

}
