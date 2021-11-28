<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    public function testHome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Recent Lists');

        $response->assertSee('Recent Items');

        $response->assertSee('Log in');

        $response->assertSee('Register');
    }
}