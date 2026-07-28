<?php

namespace Tests\Feature;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Subscription;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantIsolationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_access_or_query_other_gym_members(): void
    {
        $gymA = Gym::factory()->create(['name' => 'Gym Alpha']);
        $gymB = Gym::factory()->create(['name' => 'Gym Beta']);

        $userA = User::factory()->create(['gym_id' => $gymA->id]);

        $memberA = Member::factory()->create(['gym_id' => $gymA->id, 'name' => 'Alpha Member']);
        $memberB = Member::factory()->create(['gym_id' => $gymB->id, 'name' => 'Beta Member']);

        $this->actingAs($userA);

        $members = Member::all();

        $this->assertTrue($members->contains($memberA));
        $this->assertFalse($members->contains($memberB));
        $this->assertNull(Member::find($memberB->id));
    }

    public function test_user_cannot_access_or_query_other_gym_trainers(): void
    {
        $gymA = Gym::factory()->create(['name' => 'Gym Alpha']);
        $gymB = Gym::factory()->create(['name' => 'Gym Beta']);

        $userA = User::factory()->create(['gym_id' => $gymA->id]);

        $trainerA = Trainer::factory()->create(['gym_id' => $gymA->id, 'name' => 'Alpha Trainer']);
        $trainerB = Trainer::factory()->create(['gym_id' => $gymB->id, 'name' => 'Beta Trainer']);

        $this->actingAs($userA);

        $trainers = Trainer::all();

        $this->assertTrue($trainers->contains($trainerA));
        $this->assertFalse($trainers->contains($trainerB));
        $this->assertNull(Trainer::find($trainerB->id));
    }

    public function test_user_cannot_access_or_query_other_gym_subscriptions(): void
    {
        $gymA = Gym::factory()->create(['name' => 'Gym Alpha']);
        $gymB = Gym::factory()->create(['name' => 'Gym Beta']);

        $userA = User::factory()->create(['gym_id' => $gymA->id]);

        $subA = Subscription::factory()->create(['gym_id' => $gymA->id]);
        $subB = Subscription::factory()->create(['gym_id' => $gymB->id]);

        $this->actingAs($userA);

        $subscriptions = Subscription::all();

        $this->assertTrue($subscriptions->contains($subA));
        $this->assertFalse($subscriptions->contains($subB));
        $this->assertNull(Subscription::find($subB->id));
    }

    public function test_unauthenticated_user_redirected_when_accessing_admin(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }
}
