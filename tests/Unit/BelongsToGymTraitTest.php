<?php

namespace Tests\Unit;

use App\Models\Gym;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BelongsToGymTraitTest extends TestCase
{
    use RefreshDatabase;

    public function test_global_scope_filters_query_by_authenticated_user_gym_id(): void
    {
        $gym1 = Gym::factory()->create();
        $gym2 = Gym::factory()->create();

        $user1 = User::factory()->create(['gym_id' => $gym1->id]);
        $user2 = User::factory()->create(['gym_id' => $gym2->id]);

        Member::factory()->count(2)->create(['gym_id' => $gym1->id]);
        Member::factory()->count(3)->create(['gym_id' => $gym2->id]);

        // Act as User 1
        $this->actingAs($user1);
        $this->assertCount(2, Member::all());
        $this->assertTrue(Member::all()->every(fn ($member) => $member->gym_id === $gym1->id));

        // Act as User 2
        $this->actingAs($user2);
        $this->assertCount(3, Member::all());
        $this->assertTrue(Member::all()->every(fn ($member) => $member->gym_id === $gym2->id));
    }

    public function test_creating_event_automatically_sets_gym_id_for_models(): void
    {
        $gym = Gym::factory()->create();
        $user = User::factory()->create(['gym_id' => $gym->id]);

        $this->actingAs($user);

        $member = Member::create([
            'name' => 'Auto Gym Member',
            'email' => 'auto@gym.com',
            'phone' => '01000000000',
        ]);

        $this->assertEquals($gym->id, $member->gym_id);
    }

    public function test_without_authenticated_user_global_scope_does_not_filter(): void
    {
        $gym1 = Gym::factory()->create();
        $gym2 = Gym::factory()->create();

        Member::factory()->create(['gym_id' => $gym1->id]);
        Member::factory()->create(['gym_id' => $gym2->id]);

        $this->assertCount(2, Member::all());
    }
}
