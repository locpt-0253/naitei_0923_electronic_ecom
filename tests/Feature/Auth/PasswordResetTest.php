<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function testResetPasswordLinkScreenCanBeRendered()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function testResetPasswordLinkCanBeRequested()
    {
        Notification::fake();

        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function testResetPasswordScreenCanBeRendered()
    {
        Notification::fake();

        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification) {
                $response = $this->get('/reset-password/' . $notification->token);

                $response->assertStatus(200);

                return true;
            }
        );
    }

    public function testPasswordCanBeResetWithValidToken()
    {
        Notification::fake();

        (new RoleSeeder())->run();
        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification) use ($user) {
                $response = $this->post(
                    '/reset-password',
                    [
                    'token' => $notification->token,
                    'email' => $user->email,
                    'password' => '123456789',
                    'password_confirmation' => '123456789',
                    ]
                );

                $response->assertSessionHasNoErrors();

                return true;
            }
        );
    }
}
