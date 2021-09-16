<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Interest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InterestController
 */
class InterestControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $interests = Interest::factory()->count(3)->create();

        $response = $this->get(route('interest.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InterestController::class,
            'store',
            \App\Http\Requests\InterestStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $title = $this->faker->sentence(4);

        $response = $this->post(route('interest.store'), [
            'title' => $title,
        ]);

        $interests = Interest::query()
            ->where('title', $title)
            ->get();
        $this->assertCount(1, $interests);
        $interest = $interests->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $interest = Interest::factory()->create();

        $response = $this->get(route('interest.show', $interest));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InterestController::class,
            'update',
            \App\Http\Requests\InterestUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $interest = Interest::factory()->create();
        $title = $this->faker->sentence(4);

        $response = $this->put(route('interest.update', $interest), [
            'title' => $title,
        ]);

        $interest->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $interest->title);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $interest = Interest::factory()->create();

        $response = $this->delete(route('interest.destroy', $interest));

        $response->assertNoContent();

        $this->assertDeleted($interest);
    }
}
