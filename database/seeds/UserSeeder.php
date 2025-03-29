<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'id' => 1,
                'social_id' => '115025400658107605663',
                'name' => 'Milene Cavalcante',
                'provider' => 'google',
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocIeCy...',
                'email' => 'cavalcantemilene01@gmail.com',
                'rule' => 'admin',
                'remember_token' => null,
                'created_at' => Carbon::parse('2025-03-25 18:44:17'),
                'updated_at' => Carbon::parse('2025-03-25 18:44:17'),
                'affiliation' => null,
                'personal_url' => null,
            ],
        ]);
    }
}
