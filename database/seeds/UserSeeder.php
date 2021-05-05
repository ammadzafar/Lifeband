<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\User::create([
            'role_id'=> \App\Model\Role::where('name','admin')->first()->id,
            'name'=> 'ahmed',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        \App\Model\User::create([
            'role_id'=> \App\Model\Role::where('name','organization')->first()->id,
            'name'=> 'ali',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        \App\Model\User::create([
            'role_id'=> \App\Model\Role::where('name','family')->first()->id,
            'name'=> 'fahad',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('password'),
        ]);
        \App\Model\User::create([
            'role_id'=> \App\Model\Role::where('name','individual')->first()->id,
            'name'=> 'ammad',
            'email' => 'admin3@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
