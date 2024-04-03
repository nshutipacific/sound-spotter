<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Album;
use App\Http\Controllers\AlbumController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AlbumControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_albums_view()
    {
        $controller = new AlbumController();
        $response = $controller->allAlbums();

        $this->assertEquals('albums.all', $response->name());
    }

    /** @test */
    public function it_returns_index_view_with_albums()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $album = Album::factory()->create(['saved_by_user' => $user->id]);

        $controller = new AlbumController();
        $response = $controller->index();

        $this->assertEquals('albums.index', $response->name());
        $this->assertTrue($response->getData()['albums']->contains($album));
    }

    /** @test */
    public function it_stores_a_new_album()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => 'Test Album',
            'artist' => 'Test Artist',
            'image' => 'test_image.jpg',
        ];

        $request = new Request($data);

        $controller = new AlbumController();
        $response = $controller->store($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('albums', [
            'name' => 'Test Album',
            'artist' => 'Test Artist',
            'image' => 'test_image.jpg',
            'saved_by_user' => $user->id,
        ]);
    }

    /** @test */
    public function it_shows_the_specified_album()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $album = Album::factory()->create(['saved_by_user' => $user->id]);

        $controller = new AlbumController();
        $response = $controller->show($album->name);

        $this->assertEquals('albums.show', $response->name());
        $this->assertEquals($album->id, $response->getData()['album']->id);
    }

     /** @test */
     public function it_deletes_the_specified_album()
     {
         $user = User::factory()->create();
         $this->actingAs($user);
 
         $album = Album::factory()->create(['saved_by_user' => $user->id]);
 
         $controller = new AlbumController();
         $response = $controller->destroy($album->id);
 
         $this->assertEquals(200, $response->getStatusCode());
         $this->assertDatabaseMissing('albums', ['id' => $album->id]);
     }
}
