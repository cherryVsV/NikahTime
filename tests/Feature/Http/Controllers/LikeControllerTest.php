<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Like;
use App\Models\User1;
use App\Models\User2;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LikeController
 */
class LikeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $likes = Like::factory()->count(3)->create();

        $response = $this->get(route('like.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LikeController::class,
            'store',
            \App\Http\Requests\LikeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user1 = User1::factory()->create();
        $user2 = User2::factory()->create();

        $response = $this->post(route('like.store'), [
            'user1_id' => $user1->id,
            'user2_id' => $user2->id,
        ]);

        $likes = Like::query()
            ->where('user1_id', $user1->id)
            ->where('user2_id', $user2->id)
            ->get();
        $this->assertCount(1, $likes);
        $like = $likes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $like = Like::factory()->create();

        $response = $this->get(route('like.show', $like));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LikeController::class,
            'update',
            \App\Http\Requests\LikeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $like = Like::factory()->create();
        $user1 = User1::factory()->create();
        $user2 = User2::factory()->create();

        $response = $this->put(route('like.update', $like), [
            'user1_id' => $user1->id,
            'user2_id' => $user2->id,
        ]);

        $like->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user1->id, $like->user1_id);
        $this->assertEquals($user2->id, $like->user2_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $like = Like::factory()->create();

        $response = $this->delete(route('like.destroy', $like));

        $response->assertNoContent();

        $this->assertDeleted($like);
    }
}
