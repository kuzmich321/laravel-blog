<?php

namespace Tests\Feature\Api;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
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

        $userPosts = factory(Post::class, 5)->create(['user_id' => $createdUser->id]);

        $perPage = (new Post)->getPerPage();

        $paginatedPosts = (new LengthAwarePaginator($userPosts, $userPosts->count(), $perPage))
            ->setPath($url)
            ->toArray();

        $response = $this->get($url);

        $response->assertOk()
            ->assertHeader('content-type', 'application/json')
            ->assertJson($paginatedPosts);
    }
}
