<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::insert([
            [
                "name"=> "PZ-11",
            ],
            [
                "name"=> "PZ-12",
            ],
            [
                "name"=> "PZ-13",
            ],
            [
                "name"=> "PZ-21",
            ],
            [
                "name"=> "PZ-22",
            ],
            [
                "name"=> "PZ-23",
            ],
            [
                "name"=> "PZ-24",
            ],
            [
                "name"=> "PZ-25",
            ]
        ]);
    }
}
