<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Admin BKD']);
        Role::create(['name' => 'Pegawai']);
        Role::create(['name' => 'Pimpinan']);
    }
}
