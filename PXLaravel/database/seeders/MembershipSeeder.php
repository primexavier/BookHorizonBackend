<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memberships')->insert([
            'id' => 1,
            'name' => "Membership 1",
            'price' => "50000",
            'duration' => "30",
            'description' => "Publisher Test",
        ]);
    }
}
