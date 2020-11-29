<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "admin",
            'email' => 'admin@admin.com',
            'level' => 0,
            'password' => Hash::make('admin'),
            'first_name' =>  "admin",
            'last_name' =>  "admin",
            'display_name' => "admin",
            'privacy' => true,
            'phone_no' => '0812354862',
        ]);
        DB::table('authors')->insert([
            'id' => 1,
            'name' => "admin",
        ]);
        DB::table('suppliers')->insert([
            'id' => 1,
            'name' => "supplier",
            'description' => "supplier",
        ]);
        DB::table('settings')->insert([
            'id' => 1,
            'name' => "First Setting",
            'province_id' => 17,
            'city_id' => 48
        ]);
        DB::table('couriers')->insert([
            'id' => 1,
            'name' => "JNE",
            'code' => "jne",
            'logo' => "JNE"
        ]);
        DB::table('couriers')->insert([
            'id' => 2,
            'name' => "TIKI",
            'code' => "tiki",
            'logo' => "TIKI"
        ]);
        DB::table('couriers')->insert([
            'id' => 3,
            'name' => "Post Indonesia",
            'code' => "pos",
            'logo' => "POS Indonesia"
        ]);
        DB::table('payment_methods')->insert([
            'id' => 1,
            'name' => "Transfer Bank",
            'description' => "Bank",
        ]);
        DB::table('payment_methods')->insert([
            'id' => 2,
            'name' => "COD",
            'description' => "Bank",
        ]);
        DB::table('transaction_types')->insert([
            'id' => 1,
            'name' => "Buy",
            'description' => "Buy",
        ]);
        DB::table('transaction_types')->insert([
            'id' => 2,
            'name' => "Rent 1 Day",
            'description' => "Rent",
        ]);
        DB::table('transaction_types')->insert([
            'id' => 3,
            'name' => "Rent 2 Day",
            'description' => "Rent",
        ]);
        DB::table('transaction_types')->insert([
            'id' => 4,
            'name' => "Rent 3 Day",
            'description' => "Rent",
        ]);
        DB::table('languages')->insert([
            'id' => 1,
            'name' => "English",
            'country' => "England",
            'description' => "Rent",
        ]);
        DB::table('publishers')->insert([
            'id' => 1,
            'name' => "Publisher",
            'description' => "Publisher Test",
        ]);
    }
}
