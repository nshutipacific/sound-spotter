<?php

namespace Tests\Feature\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tests\TestCase;

class GoogleControllerTest extends TestCase
{
    public function testRedirectToGoogle()
    {
        Socialite::shouldReceive('driver->redirect')->andReturn('http://localhost:8000/google/callback');

        $controller = new GoogleController();

        $response = $controller->redirectToGoogle();

        $this->assertEquals('http://localhost:8000/google/callback', $response);
    }
}
