<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::truncate();
        factory(User::class, 100) -> create();
        User::where('id', 1)->update(['username' => 'admin', 'role_id' => '1']);
        User::where('id', 100)->update(['username' => 'root', 'role_id' => '1']);
    }
}
 