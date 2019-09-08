<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'username' => 'testuser',
            'email' => 'testuser@gmail.com',
            'password' => Hash::make('testuser'),
            'api_token' => 'B6bJs7OGv64kuN4mmoxhJpYW3x3UxdklRYmMSvcmE59v1RriZSYLvdoUfDYD'
        ]);

        DB::table('users')->insert([
            'username' => 'johnSnow99',
            'email' => 'johnSnow99@gmail.com',
            'password' => Hash::make('johny'),
            'api_token' => Str::random(60)
        ]);

        DB::table('users')->insert([
            'username' => 'st@rk',
            'email' => 'st@rk@gmail.com',
            'password' => Hash::make('st@rkyBoy'),
            'api_token' => Str::random(60)
        ]);

        DB::table('users')->insert([
            'username' => 'tyri0n',
            'email' => 'tyri0n@gmail.com',
            'password' => Hash::make('tyri0nL@nniSt3r'),
            'api_token' => Str::random(60)
        ]);
    }
}
