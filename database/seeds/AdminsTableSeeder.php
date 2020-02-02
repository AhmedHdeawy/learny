<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username'      =>  "learny",
            'email'     =>  'admin@learny.com',
            'password'  =>  bcrypt('password'),
        ]);

        Admin::create([
            'username'      =>  "Ahmed Hdeawy",
            'email'     =>  'ahmed@admin.com',
            'password'  =>  bcrypt('password'),
        ]);
    }
}
