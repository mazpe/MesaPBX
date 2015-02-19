<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        $users = [
            [
                "name"          => "Lester Mesa",
                "username"      => "lester",
                "password"      => Hash::make('password'),
                "email"         => "lesterm@gmail.com",
            ],
            [
                "name"          => "Lester Mesa",
                "username"      => "lester",
                "password"      => Hash::make('password'),
                "email"         => "lesterm@gmail.com",
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}