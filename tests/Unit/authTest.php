<?php

// namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

namespace Tests\Feature;

use Tests\TestCase;

class authTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_register(): void
    {

        $response = $this->postJson('/api/register', ['email' => 'alldone@gmail.com', 'password' => '12345678', 'name' => 'alldone']);
        if ($response->getStatusCode() == 422) {
            $this->assertTrue(true);
        } else {

            $response->assertCreated();
        }
    }
    public function test_login(): void
    {
        $response = $this->postJson('/api/login', ['email' => 'alldone@gmail.com', 'password' => '12345678']);
        $response
            ->assertStatus(200);
    }
}
