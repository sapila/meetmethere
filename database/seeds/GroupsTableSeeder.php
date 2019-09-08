<?php

use App\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'HouseOfStark',
            'description' => 'Kingdom of the North.',
            'owner_user_id' => 3,
        ]);

        DB::table('groups')->insert([
            'name' => 'House Of Lannister ',
            'description' => 'Greatest House of Westeros',
            'owner_user_id' => 4,
        ]);

        $group = Group::where('id', 1)->first();
        $group->users()->attach(3);

        $group = Group::where('id', 2)->first();
        $group->users()->attach(4);

        $group = Group::where('id', 1)->first();
        $group->users()->attach(1);
    }
}
