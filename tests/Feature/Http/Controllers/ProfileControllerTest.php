<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Education;
use App\Models\Habit;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Auth\Auth\Auth\ProfileController
 */
class ProfileControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $profiles = Profile::factory()->count(3)->create();

        $response = $this->get(route('profile.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Auth\Auth\Auth\ProfileController::class,
            'store',
            \App\Http\Requests\ProfileStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $avatar = $this->faker->word;
        $name = $this->faker->name;
        $gender = $this->faker->word;
        $birthdate = $this->faker->date();
        $country = $this->faker->country;
        $town = $this->faker->word;
        $education = Education::factory()->create();
        $place_of_study = $this->faker->word;
        $place_of_work = $this->faker->word;
        $post = $this->faker->word;
        $marital_status = MaritalStatus::factory()->create();
        $children = $this->faker->boolean;
        $habit = Habit::factory()->create();
        $about_me = $this->faker->text;

        $response = $this->post(route('profile.store'), [
            'user_id' => $user->id,
            'avatar' => $avatar,
            'name' => $name,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'country' => $country,
            'town' => $town,
            'education_id' => $education->id,
            'place_of_study' => $place_of_study,
            'place_of_work' => $place_of_work,
            'post' => $post,
            'marital_status_id' => $marital_status->id,
            'children' => $children,
            'habit_id' => $habit->id,
            'about_me' => $about_me,
        ]);

        $profiles = Profile::query()
            ->where('user_id', $user->id)
            ->where('avatar', $avatar)
            ->where('name', $name)
            ->where('gender', $gender)
            ->where('birthdate', $birthdate)
            ->where('country', $country)
            ->where('town', $town)
            ->where('education_id', $education->id)
            ->where('place_of_study', $place_of_study)
            ->where('place_of_work', $place_of_work)
            ->where('post', $post)
            ->where('marital_status_id', $marital_status->id)
            ->where('children', $children)
            ->where('habit_id', $habit->id)
            ->where('about_me', $about_me)
            ->get();
        $this->assertCount(1, $profiles);
        $profile = $profiles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $profile = Profile::factory()->create();

        $response = $this->get(route('profile.show', $profile));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Auth\Auth\Auth\ProfileController::class,
            'update',
            \App\Http\Requests\ProfileUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $profile = Profile::factory()->create();
        $user = User::factory()->create();
        $avatar = $this->faker->word;
        $name = $this->faker->name;
        $gender = $this->faker->word;
        $birthdate = $this->faker->date();
        $country = $this->faker->country;
        $town = $this->faker->word;
        $education = Education::factory()->create();
        $place_of_study = $this->faker->word;
        $place_of_work = $this->faker->word;
        $post = $this->faker->word;
        $marital_status = MaritalStatus::factory()->create();
        $children = $this->faker->boolean;
        $habit = Habit::factory()->create();
        $about_me = $this->faker->text;

        $response = $this->put(route('profile.update', $profile), [
            'user_id' => $user->id,
            'avatar' => $avatar,
            'name' => $name,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'country' => $country,
            'town' => $town,
            'education_id' => $education->id,
            'place_of_study' => $place_of_study,
            'place_of_work' => $place_of_work,
            'post' => $post,
            'marital_status_id' => $marital_status->id,
            'children' => $children,
            'habit_id' => $habit->id,
            'about_me' => $about_me,
        ]);

        $profile->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $profile->user_id);
        $this->assertEquals($avatar, $profile->avatar);
        $this->assertEquals($name, $profile->name);
        $this->assertEquals($gender, $profile->gender);
        $this->assertEquals(Carbon::parse($birthdate), $profile->birthdate);
        $this->assertEquals($country, $profile->country);
        $this->assertEquals($town, $profile->town);
        $this->assertEquals($education->id, $profile->education_id);
        $this->assertEquals($place_of_study, $profile->place_of_study);
        $this->assertEquals($place_of_work, $profile->place_of_work);
        $this->assertEquals($post, $profile->post);
        $this->assertEquals($marital_status->id, $profile->marital_status_id);
        $this->assertEquals($children, $profile->children);
        $this->assertEquals($habit->id, $profile->habit_id);
        $this->assertEquals($about_me, $profile->about_me);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $profile = Profile::factory()->create();

        $response = $this->delete(route('profile.destroy', $profile));

        $response->assertNoContent();

        $this->assertDeleted($profile);
    }
}
