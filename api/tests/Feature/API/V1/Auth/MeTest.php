<?php

namespace Tests\Feature\API\V1\Auth;

use App\Domains\User\Models\User;
use Tests\TestCase;

class MeTest extends TestCase
{
    /** @test */
    public function it_fails_if_user_is_not_authenticated(): void
    {
        $this->getFromApi('auth/me')
            ->assertStatus(401);
    }

    /** @test */
    public function it_returns_user_details_when_authenticated(): void
    {
        $user = create(User::class);
        $this->jsonGetAs($user, 'auth/me')
            ->assertJsonFragment([
                'email' => $user->email
            ]);
    }
}
