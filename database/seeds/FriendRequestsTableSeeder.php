<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend_requests')->insert([
            'from_user_id' => 1,
            'to_user_id' => 2,
            'status' => 'accepted',
        ]);

        DB::table('friend_requests')->insert([
            'from_user_id' => 4,
            'to_user_id' => 1,
            'status' => 'pending',
        ]);

        $user = User::where('id', 1)->first();
        $user->friends()->attach(2);
    }
}
