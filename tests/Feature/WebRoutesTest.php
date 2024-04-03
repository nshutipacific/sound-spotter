<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebRoutesTest extends TestCase
{
    /**
     * Test if the home page returns a 200 status code.
     */
    public function test_home_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test if the dashboard page returns a 200 status code.
     */
    public function test_dashboard_page(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Test if the logout route redirects to the home page.
     */
    public function test_logout_route(): void
    {
        $response = $this->get('/logout');
        $response->assertRedirect('/');
    }

    /**
     * Test if the artists index route returns a 200 status code.
     */
    public function test_artists_index_route(): void
    {
        $response = $this->get('/artists');
        $response->assertStatus(200);
    }

    /**
     * Test if the albums index route returns a 200 status code.
     */
    public function test_albums_index_route(): void
    {
        $response = $this->get('/albums');
        $response->assertStatus(200);
    }

    /**
     * Test if the all-artists route returns a 200 status code.
     */
    public function test_all_artists_route(): void
    {
        $response = $this->get('/all-artists');
        $response->assertStatus(200);
    }

    /**
     * Test if the all-albums route returns a 200 status code.
     */
    public function test_all_albums_route(): void
    {
        $response = $this->get('/all-albums');
        $response->assertStatus(200);
    }
}