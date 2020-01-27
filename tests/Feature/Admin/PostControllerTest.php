<?php

namespace Tests\Feature\Admin;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function testIndex()
    {
        $actingUser = factory(User::class)->create();

        factory(Post::class, 3)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.posts.index'));

        $response->assertOk()
            ->assertViewIs('admin.posts.index')
            ->assertViewHas('posts');
    }

    /** @test */
    public function testShow()
    {
        $actingUser = factory(User::class)->create();

        $post = factory(Post::class)->create();

        $response = $this->actingAs($actingUser)
            ->get(route('admin.posts.show', $post));

        $response->assertOk()
            ->assertViewIs('admin.posts.show')
            ->assertViewHas('post');
    }
}
