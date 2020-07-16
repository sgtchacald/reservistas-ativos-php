<?php

use Illuminate\Database\Seeder;
use App\User;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
           'name' => 'Diego dos Santos Cordeiro',
           'email' => 'sgt.chacal.d@gmail.com',
           'password' => bcrypt('d123456768d'),
       ]);
    }
}
