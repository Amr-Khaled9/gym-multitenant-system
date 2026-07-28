<?php

namespace Tests\Unit;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Subscription;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_belongs_to_gym(): void
    {
        $gym = Gym::factory()->create();
        $user = User::factory()->create(['gym_id' => $gym->id]);

        $this->assertInstanceOf(Gym::class, $user->gym);
        $this->assertEquals($gym->id, $user->gym->id);
    }

    public function test_member_relationships(): void
    {
        $gym = Gym::factory()->create();
        $trainer = Trainer::factory()->create(['gym_id' => $gym->id]);
        $member = Member::factory()->create([
            'gym_id' => $gym->id,
            'trainer_id' => $trainer->id,
        ]);
        $subscription = Subscription::factory()->create([
            'gym_id' => $gym->id,
            'member_id' => $member->id,
        ]);

        $this->assertInstanceOf(Gym::class, $member->gym);
        $this->assertInstanceOf(Trainer::class, $member->trainer);
        $this->assertTrue($member->subscriptions->contains($subscription));
    }

    public function test_trainer_relationships(): void
    {
        $gym = Gym::factory()->create();
        $trainer = Trainer::factory()->create(['gym_id' => $gym->id]);
        $member = Member::factory()->create([
            'gym_id' => $gym->id,
            'trainer_id' => $trainer->id,
        ]);

        $this->assertInstanceOf(Gym::class, $trainer->gym);
        $this->assertTrue($trainer->members->contains($member));
    }

    public function test_subscription_relationships(): void
    {
        $gym = Gym::factory()->create();
        $member = Member::factory()->create(['gym_id' => $gym->id]);
        $subscription = Subscription::factory()->create([
            'gym_id' => $gym->id,
            'member_id' => $member->id,
        ]);

        $this->assertInstanceOf(Gym::class, $subscription->gym);
        $this->assertInstanceOf(Member::class, $subscription->member);
        $this->assertEquals($member->id, $subscription->member->id);
    }
}
