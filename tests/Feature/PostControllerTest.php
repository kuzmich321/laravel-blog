<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testIndex()
    {
        $posts = factory(Post::class, 2)->states('with_user')->create();

        $response = $this->get(route('posts.index'));

        $receivedData = $response->getOriginalContent()->getData($posts);

        $response->assertStatus(200)->assertViewIs('posts.index')->assertViewHasAll($receivedData);
    }

    /**
     * @test
     */
    public function testShow()
    {
        $post = factory(Post::class)->states('with_user')->create();

        $response = $this->get(route('posts.show', $post));

        $receivedData = $response->getOriginalContent()->getData($post);

        $response->assertStatus(200)->assertViewIs('posts.show')->assertViewHasAll($receivedData);
    }
}
