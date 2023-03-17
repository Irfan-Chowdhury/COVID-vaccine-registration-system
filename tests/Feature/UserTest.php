<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_the_url_returns_authenticate_users_data(): void
    {
        $response = $this->get('/users/authenticate');
        $response->assertStatus(200);
    }

    public function test_user_authenticate(): void
    {
        $results = User::where('nid', 7643814714935291)->first();
        $this->assertNotNull($results);
    }

    public function test_user_not_authenticate(): void
    {
        $results = User::where('nid', 7643814714935290)->first();
        $this->assertNull($results);
    }

    // php artisan test --filter UserTest
}
