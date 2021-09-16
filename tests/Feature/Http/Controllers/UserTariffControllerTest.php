<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Tariff;
use App\Models\User;
use App\Models\UserTariff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserTariffController
 */
class UserTariffControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $userTariffs = UserTariff::factory()->count(3)->create();

        $response = $this->get(route('user-tariff.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserTariffController::class,
            'store',
            \App\Http\Requests\UserTariffStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $tariff = Tariff::factory()->create();
        $period = $this->faker->numberBetween(-10000, 10000);
        $payment_amount = $this->faker->numberBetween(-10000, 10000);
        $finished_at = $this->faker->dateTime();

        $response = $this->post(route('user-tariff.store'), [
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'period' => $period,
            'payment_amount' => $payment_amount,
            'finished_at' => $finished_at,
        ]);

        $userTariffs = UserTariff::query()
            ->where('user_id', $user->id)
            ->where('tariff_id', $tariff->id)
            ->where('period', $period)
            ->where('payment_amount', $payment_amount)
            ->where('finished_at', $finished_at)
            ->get();
        $this->assertCount(1, $userTariffs);
        $userTariff = $userTariffs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $userTariff = UserTariff::factory()->create();

        $response = $this->get(route('user-tariff.show', $userTariff));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserTariffController::class,
            'update',
            \App\Http\Requests\UserTariffUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $userTariff = UserTariff::factory()->create();
        $user = User::factory()->create();
        $tariff = Tariff::factory()->create();
        $period = $this->faker->numberBetween(-10000, 10000);
        $payment_amount = $this->faker->numberBetween(-10000, 10000);
        $finished_at = $this->faker->dateTime();

        $response = $this->put(route('user-tariff.update', $userTariff), [
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'period' => $period,
            'payment_amount' => $payment_amount,
            'finished_at' => $finished_at,
        ]);

        $userTariff->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $userTariff->user_id);
        $this->assertEquals($tariff->id, $userTariff->tariff_id);
        $this->assertEquals($period, $userTariff->period);
        $this->assertEquals($payment_amount, $userTariff->payment_amount);
        $this->assertEquals($finished_at, $userTariff->finished_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $userTariff = UserTariff::factory()->create();

        $response = $this->delete(route('user-tariff.destroy', $userTariff));

        $response->assertNoContent();

        $this->assertDeleted($userTariff);
    }
}
