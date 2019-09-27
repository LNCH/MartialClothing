<?php

namespace Tests\Feature\API\V1\Auth;

use App\Domains\User\Models\User;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    /** @test */
    public function it_requires_a_name(): void
    {
        $this->postToApi('auth/register', [])
            ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_an_email(): void
    {
        $this->postToApi('auth/register', [])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_valid_email(): void
    {
        $this->postToApi('auth/register', ['email' => 567])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_unique_email(): void
    {
        $user = create(User::class);

        $this->postToApi('auth/register', ['email' => $user->email])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_password(): void
    {
        $this->postToApi('auth/register', [])
            ->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_registers_a_user(): void
    {
        $this->postToApi('auth/register', [
            'name' => 'New User',
            'email' => $email = 'user@email.com',
            'password' => 'password'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    /** @test */
    public function it_returns_the_user_resource(): void
    {
        $response = $this->postToApi('auth/register', [
            'name' => 'New User',
            'email' => $email = 'user@email.com',
            'password' => 'password'
        ]);

        $response->assertJsonFragment(['email' => $email]);
    }
}
