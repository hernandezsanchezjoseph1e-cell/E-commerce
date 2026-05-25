<?php

namespace Tests\Feature\Auth;

use App\Mail\CodigoVerificacionMail;
use App\Models\CodigoVerificacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_start_login_and_receive_2fa_code(): void
    {
        Mail::fake();

        $user = User::factory()->create([
            'role' => 'cliente',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();

        $response
            ->assertRedirect(route('2fa.show'))
            ->assertSessionHas('2fa_user_id', $user->id);

        $this->assertTrue(
            CodigoVerificacion::where('user_id', $user->id)
                ->where('usado', false)
                ->exists()
        );

        Mail::assertSent(CodigoVerificacionMail::class);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        Mail::fake();

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();

        $this->assertFalse(
            CodigoVerificacion::where('user_id', $user->id)->exists()
        );

        Mail::assertNothingSent();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/logout');

        $this->assertGuest();

        $response->assertRedirect('/');
    }
}
