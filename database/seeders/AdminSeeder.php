<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Tasya";
        $user->password = Hash::make('rahas1a!');
        $user->email = "tasyadas@mail.com";
        $user->role()->associate(Role::find(1));

        $user->save();
    }
}
