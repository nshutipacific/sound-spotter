<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Artist;
use App\Http\Controllers\ArtistController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ArtistControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_artists_view()
    {
       $controller = new ArtistController();
        $response = $controller->allArtists();

        $this->assertEquals('artists.all', $response->name());
    }

    /** @test */
    public function it_returns_index_view_with_artists()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $artist = Artist::factory()->create(['saved_by_user' => $user->id]);

        $controller = new ArtistController();
        $response = $controller->index();

        $this->assertEquals('artists.index', $response->name());
        $this->assertTrue($response->getData()['artists']->contains($artist));
    }

    /** @test */
    public function it_stores_a_new_artist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'mbid' => 'test_mbid',
            'name' => 'Test Artist',
            'image' => 'test_image.jpg',
            'listeners' => 1000,
        ];

        $request = new Request($data);

        $controller = new ArtistController();
        $response = $controller->store($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('artists', [
            'mbid' => 'test_mbid',
            'name' => 'Test Artist',
            'image' => 'test_image.jpg',
            'listeners' => 1000,
            'saved_by_user' => $user->id,
        ]);
    }

    /** @test */
    public function it_shows_the_specified_artist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $artist = Artist::factory()->create(['saved_by_user' => $user->id]);

        $controller = new ArtistController();
        $response = $controller->show($artist->mbid);

        $this->assertEquals('artists.show', $response->name());
        $this->assertEquals($artist->id, $response->getData()['artist']->id);
    }

    /** @test */
    public function it_deletes_the_specified_artist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $artist = Artist::factory()->create(['saved_by_user' => $user->id]);

        $controller = new ArtistController();
        $response = $controller->destroy($artist->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseMissing('artists', ['id' => $artist->id]);
    }

    /** @test */
    public function it_updates_the_specified_artist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $artist = Artist::factory()->create(['saved_by_user' => $user->id]);

        $data = [
            'id' => $artist->id,
            'mbid' => 'updated_mbid',
            'name' => 'Updated Artist',
            'image' => 'updated_image.jpg',
            'listeners' => 2000,
        ];

        $request = new Request($data);

        $controller = new ArtistController();
        $response = $controller->update($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('artists', [
            'id' => $artist->id,
            'mbid' => 'updated_mbid',
            'name' => 'Updated Artist',
            'image' => 'updated_image.jpg',
            'listeners' => 2000,
        ]);
    }
}
