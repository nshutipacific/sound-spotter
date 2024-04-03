<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiRoutesTest extends TestCase
{
    public function test_albums_route()
    {
        $response = $this->get('/api/albums');
        $response->assertStatus(200)->assertJsonStructure(['results']);
    }

    public function test_artists_route()
    {
        $response = $this->get('/api/artists');
        $response->assertStatus(200)->assertJsonStructure(['results']);
    }

    public function test_artist_info_route()
    {
        $response = $this->get('/api/artist/info');
        $response->assertStatus(200)->assertJsonStructure(['artistInfo', 'artistTopAlbums', 'artistTopTracks', 'artistSimilarArtsists']);
    }

    public function test_album_info_route()
    {
        $response = $this->get('/api/album/info');
        $response->assertStatus(200);
    }
}
