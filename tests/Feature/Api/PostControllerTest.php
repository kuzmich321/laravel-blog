<?php

namespace Tests\Feature\Api;

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
    //TODO it expects to get data from pagination but in fact it gets pagination itself
    public function testIndex()
    {
        $createdUser = factory(User::class)->create();

        $userPosts = factory(Post::class, 5)->create(['user_id' => $createdUser->id]);

        $response = $this->get(route('api.posts.index'));

        $response->assertOk()
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment(array(
                'data' => $userPosts
            ));
    }
}
