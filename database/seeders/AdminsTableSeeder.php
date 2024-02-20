<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            [  'name' => 'admin', 'type' => 'admin', 'mobile' => '1234567890', 'email' => 'viprestal@hotmail.com', 'password' => bcrypt('123456'), 'image' => '','status' => 1],

        ];
        Admin::insert($adminRecords);

    }
}
