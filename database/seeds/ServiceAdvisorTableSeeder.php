<?php
use Illuminate\Database\Seeder;
use App\ServiceAdvisor;

class ServiceAdvisorTableSeeder extends DatabaseSeeder
{
    public function run()
    {
        $serviceadvivors = [
            [
                "name"              => "Fernando Gonzales",
                "number"            => "1111",
                "extension"         => "1001",
                "pushbullet_token"  => "1234567890",
                "email"             => "fernando.gonzales@brickellmotors.com",
            ],
            [
                "name"              => "Islay Perez",
                "number"            => "1112",
                "extension"         => "1002",
                "pushbullet_token"  => "2345678901",
                "email"             => "islay.perez@brickellmotors.com",
            ],
        ];

        foreach ($serviceadvivors as $serviceadvivor) {
            ServiceAdvisor::create($serviceadvivor);
        }
    }
}