<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classifications')->delete();
        DB::table('classifications')->insert([
            ['id' => 1, 'description' => 'New Construct'],
            ['id' => 2, 'description' => 'Adaptation'],
        ]);
    }
}
