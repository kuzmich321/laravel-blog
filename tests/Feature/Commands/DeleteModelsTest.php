<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\DeleteModels;
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

        $this->artisan(DeleteModels::class);

        $this->assertDatabaseMissing('users', array($softDeletedUser));
    }
}
