<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\TokenController;
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
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678')
        ]);

        $token = TokenController::getToken($user->toArray());

        dump($token->plainTextToken);
    }
}
