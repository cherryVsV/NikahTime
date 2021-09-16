<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Chat;
use App\Models\User1;
use App\Models\User2;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChatController
 */
class ChatControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $chats = Chat::factory()->count(3)->create();

        $response = $this->get(route('chat.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChatController::class,
            'store',
            \App\Http\Requests\ChatStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user1 = User1::factory()->create();
        $user2 = User2::factory()->create();

        $response = $this->post(route('chat.store'), [
            'user1_id' => $user1->id,
            'user2_id' => $user2->id,
        ]);

        $chats = Chat::query()
            ->where('user1_id', $user1->id)
            ->where('user2_id', $user2->id)
            ->get();
        $this->assertCount(1, $chats);
        $chat = $chats->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $chat = Chat::factory()->create();

        $response = $this->get(route('chat.show', $chat));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChatController::class,
            'update',
            \App\Http\Requests\ChatUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $chat = Chat::factory()->create();
        $user1 = User1::factory()->create();
        $user2 = User2::factory()->create();

        $response = $this->put(route('chat.update', $chat), [
            'user1_id' => $user1->id,
            'user2_id' => $user2->id,
        ]);

        $chat->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user1->id, $chat->user1_id);
        $this->assertEquals($user2->id, $chat->user2_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $chat = Chat::factory()->create();

        $response = $this->delete(route('chat.destroy', $chat));

        $response->assertNoContent();

        $this->assertSoftDeleted($chat);
    }
}
