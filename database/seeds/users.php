<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username='admin'.rand();
        DB::table('users')->insert([
            'name' => $username,
            'email' => $username.'@ods.vn',
            'password' => bcrypt('secret'),
        ]);
    }
}
