<?php
class UserSeeder
extends DatabaseSeeder
{
    public function run()
    {
        $users = [
            [
                "email" => "trevor.sawler@me.com",
                "name" => "Trevor Sawler",
                "password" => Hash::make("marlow11"),
                "access_level"    => "3"
            ]
        ];
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}