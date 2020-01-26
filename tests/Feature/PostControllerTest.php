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
        factory(Post::class, 2)->create();

        $response = $this->get(route('posts.index'));

        $response->assertOk()
            ->assertViewIs('posts.index')
            ->assertViewHas('posts');
    }

    /**
     * @test
     */
    public function testShow()
    {
        $post = factory(Post::class)->create();

        $response = $this->get(route('posts.show', $post));

        $response->assertOk()
            ->assertViewIs('posts.show')
            ->assertViewHas('post');
    }
}
