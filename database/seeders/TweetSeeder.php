<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tweet = new Tweet();
        $Tweet->content = "hola como estas este es mi primer tweet.";
        $Tweet->user_id = 1;
        $Tweet->save();

        $Tweet = new Tweet();
        $Tweet->content = "hola como estas este es mi primer tweet soy Leider.";
        $Tweet->user_id = 2;
        $Tweet->save();
    }
}
