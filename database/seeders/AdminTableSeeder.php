<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $adminRecords = [
            ['id'=>2, 'name'=>'Afriqil','type'=>'subadmin','mobile'=>9700000000, 'email'=>'afriqil@admin.com', 'password'=>$password, 'image'=>'','status'=>1],
            
            ['id'=>3, 'name'=>'Wildan','type'=>'subadmin','mobile'=>9900000000, 'email'=>'wildan@admin.com', 'password'=>$password, 'image'=>'','status'=>1],

        ];
        Admin::insert($adminRecords);
    }
}
