<?php

namespace Tests\Unit\Domains\User\Models;

use App\Domains\User\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_hashes_password_when_creating(): void
    {
        $user = create(User::class, ['password' => 'password']);

        $this->assertNotEquals($user->password, 'password');
    }
}
