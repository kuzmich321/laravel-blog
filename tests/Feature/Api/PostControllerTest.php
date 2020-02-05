<?php

namespace Tests\Feature\Api;

use App\Http\Resources\PostCollection;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testIndex()
    {
        $url = route('api.posts.index');

        $createdUser = factory(User::class)->create();

        factory(Post::class, 5)->create(['user_id' => $createdUser->id]);

        $paginatedPosts = (new PostCollection(Post::paginate()))->resolve();

        $response = $this->get($url);

        $response->assertOk()
            ->assertHeader('content-type', 'application/json')
            ->assertJson(array(
                'data' => $paginatedPosts
            ));

    }
}
