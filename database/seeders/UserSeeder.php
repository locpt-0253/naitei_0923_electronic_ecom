<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'is_active' => true,
            'gender' => 1,
            'role_id' => DB::table('roles')->where('name', 'Admin')->first()->id,
        ]);

        User::factory(100)->create();
    }
}
