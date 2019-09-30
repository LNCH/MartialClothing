<?php

namespace Tests\Feature\API\V1\Auth;

use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function it_requires_an_email(): void
    {
        $this->postToApi('auth/login')
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_password(): void
    {
        $this->postToApi('auth/login')
            ->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_returns_a_validation_error_if_the_credentials_dont_match(): void
    {
        $user = create(User::class)->create();

        $this->postToApi('auth/login', [
            'email' => $user->email,
            'password' => 'nah'
        ])->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_returns_a_token_if_credentials_do_match(): void
    {
        $user = create(User::class, ['password' => 'cats']);

        $this->postToApi('auth/login', [
            'email' => $user->email,
            'password' => 'cats',
        ])->assertJsonStructure([
            'meta' => [
                'token'
            ]
        ]);
    }

    /** @test */
    public function it_returns_a_user_if_credentials_do_match(): void
    {
        $user = create(User::class, ['password' => 'cats']);

        $this->postToApi('auth/login', [
            'email' => $user->email,
            'password' => 'cats',
        ])->assertJsonFragment([
            'email' => $user->email
        ]);
    }
}
