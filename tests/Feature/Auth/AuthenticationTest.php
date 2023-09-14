<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginScreenCanBeRendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testUsersCanAuthenticateUsingTheLoginScreen()
    {
        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $response = $this->post(
            '/login',
            [
            'email' => $user->email,
            'password' => '123456789',
            ]
        );

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function testUsersCanNotAuthenticateWithInvalidPassword()
    {
        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $this->post(
            '/login',
            [
            'email' => $user->email,
            'password' => 'wrong-password',
            ]
        );

        $this->assertGuest();
    }
}
