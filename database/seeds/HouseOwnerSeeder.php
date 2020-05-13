<?php

use App\Models\HouseOwner;
use Illuminate\Database\Seeder;

class HouseOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        HouseOwner::truncate();

        factory(HouseOwner::class, 100) -> create();
    }
}
