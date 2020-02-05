<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\DeleteModels;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteModelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function testDeleteModelsCommand()
    {
        $softDeletedUser = factory(User::class)->create([
            'deleted_at' => today()->subDay()->toDateTime()
        ]);

        $softDeletedPost = factory(Post::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'deleted_at' => today()->subDay()->toDateTime()
        ]);

        $this->artisan(DeleteModels::class);

        $this->assertDeleted('users', [$softDeletedUser]);
        $this->assertDeleted('posts', [$softDeletedPost]);
    }
}
