<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'info@life-is-music.de',
            'password' => bcrypt('Test1234'),
            'type' => User::ADMIN_TYPE,
        ]);
        //
    }
}
