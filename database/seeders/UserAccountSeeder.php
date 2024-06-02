<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'username'=>'admin',
                'name'=>'AkunAdmin',
                'email'=>'admin@gmail.com',
                'phone'=>'08123456789',
                'address'=>'Jl. Raya No. 1',
                'level'=>'admin',
                'password'=>Hash::make('123456')
            ],
            
            [
                'username'=>'user1',
                'name'=>'AkunUser1',
                'email'=>'user1@gmail.com',
                'phone'=>'08123456789',
                'address'=>'Jl. Raya No. 1',
                'level'=>'user',
                'password'=>Hash::make('123456')
            ],
            [
                'username'=>'user2',
                'name'=>'AkunUser2',
                'email'=>'user2@gmail.com',
                'phone'=>'08123456789',
                'address'=>'Jl. Raya No. 1',
                'level'=>'user',
                'password'=>Hash::make('123456')
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
