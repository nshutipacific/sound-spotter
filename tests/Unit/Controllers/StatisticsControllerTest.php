<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Artist;
use App\Models\Album;
use App\Models\User;
use App\Http\Controllers\StatisticsController;
use Illuminate\Foundation\Testing\RefreshDatabase;


class StatisticsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_stats_for_specific_route()
    {
        $user = User::factory()->create();

        $userArtistsCount = 3;
        $userAlbumsCount = 5;

        Artist::factory()->count($userArtistsCount)->create(['saved_by_user' => $user->id]);
        Album::factory()->count($userAlbumsCount)->create(['saved_by_user' => $user->id]);

        $this->actingAs($user);

        $response = $this->json('GET', '/stats');

        $response->assertJson([
            'total_artists' => $userArtistsCount,
            'total_albums' => $userAlbumsCount,
        ]);
    }
}
