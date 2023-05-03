<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function testLogin()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = $this->faker->word()),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);
    }
}
