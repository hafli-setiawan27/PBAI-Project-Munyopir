<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_homepage_shows_a_landing_page_for_guests(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertViewIs('landing')
            ->assertSee('Kerja lebih tertata')
            ->assertSee('Mulai gunakan Munyopir')
            ->assertSee(asset('logo-munyopir.svg'))
            ->assertSee('Logo Munyopir')
            ->assertSee(route('login'))
            ->assertSee(route('register'));
    }

    public function test_the_homepage_redirects_authenticated_users_to_the_dashboard(): void
    {
        $this->actingAs(User::factory()->make())
            ->get('/')
            ->assertRedirect(route('dashboard'));
    }
}
