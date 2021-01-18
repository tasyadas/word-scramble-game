<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'admin',
            'user'
        ];

        foreach ($user as $role) {
            Role::insert([
                'name' => $role
            ]);
        }
    }
}
