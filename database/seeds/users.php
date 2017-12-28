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
        $array=array('admin','voip','support','sale');
        foreach ($array as $value){

            if($value == 'sale'){
                for($i=1;$i<6;$i++)
                {
                    $username=$value.$i;
                    $password=$username.'@secret';
                    DB::table('users')->insert([
                        'name' => $username,
                        'email' => $username.'@ods.vn',
                        'password' => bcrypt($password),
                    ]);
                }
            }
            else{
                $username=$value.rand();
                $password=$username.'@secret';
                DB::table('users')->insert([
                    'name' => $username,
                    'email' => $username.'@ods.vn',
                    'password' => bcrypt($password),
                ]);
            }
        }

    }
}
