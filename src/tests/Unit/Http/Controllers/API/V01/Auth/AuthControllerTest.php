<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Register
     */
    public function test_register_should_be_validate()
    {
        $response = $this->postJson(route('auth.register'));

        $response->assertStatus(422);
    }

    public function test_new_user_can_register()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => "Mohsen Bostan",
            'email' => "mohsenbostandev@gmail.com",
            'password' => "12345678",
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test Login
     */
    public function test_login_should_be_validate()
    {
        $response = $this->postJson(route('auth.login'));

        $response->assertStatus(422);
    }

    public function test_user_can_login_with_true_credentials()
    {
        $user = factory(User::class)->create();
        $response = $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test Logged In User
     */
    public function test_show_user_info_if_logged_in()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('auth.user'));

        $response->assertStatus(200);
    }

    /**
     * Test Logout
     */
    public function test_logged_in_user_can_logout()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson(route('auth.logout'));

        $response->assertStatus(200);
    }
}
