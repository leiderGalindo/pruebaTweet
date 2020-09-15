<?php

namespace Database\Seeders;

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
        $User = new User();
        $User->name ="admin";
        $User->email = "admin@gmail.com";
        $User->password = bcrypt('admin');
        $User->save();

        $User = new User();
        $User->name ="Leider";
        $User->email = "000999zzz44@gmail.com";
        $User->password = bcrypt('leider');
        $User->save();
    }
}
