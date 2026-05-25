<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'nombre' => 'Jose',
            'apellidos' => 'Hernandez',
            'email' => 'jhernandez9999@tuxtla.tecnm.mx',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'cliente',
        ]);

        $user = User::where('email', 'jhernandez9999@tuxtla.tecnm.mx')->first();

        $this->assertNotNull($user);

        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('users', [
            'nombre' => 'Jose',
            'apellidos' => 'Hernandez',
            'email' => 'jhernandez9999@tuxtla.tecnm.mx',
            'role' => 'cliente',
        ]);

        $this->assertTrue(
            Hash::check('password', $user->password)
        );

        $response->assertRedirect();
    }
}
