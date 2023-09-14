<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function testConfirmPasswordScreenCanBeRendered()
    {
        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
    }

    public function testPasswordCanBeConfirmed()
    {
        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(
            '/confirm-password',
            [
            'password' => '123456789',
            ]
        );

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testPasswordIsNotConfirmedWithInvalidPassword()
    {
        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(
            '/confirm-password',
            [
            'password' => 'wrong-password',
            ]
        );

        $response->assertSessionHasErrors();
    }
}
