<?php

namespace Tests\Feature\API\v1\Thread;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    /** @test */
    public function user_can_subscribe_to_a_thread()
    {
        Sanctum::actingAs(factory(User::class)->create());

        $thread = factory(Thread::class)->create();
        $response = $this->post(route('subscribe', [$thread]));

        $response->assertSuccessful();
        $response->assertJson([
            'message' => 'user subscribed successfully'
        ]);
    }

    /** @test */
    public function user_can_unsubscribe_from_a_thread()
    {
        Sanctum::actingAs(factory(User::class)->create());

        $thread = factory(Thread::class)->create();
        $response = $this->post(route('unSubscribe', [$thread]));

        $response->assertSuccessful();
        $response->assertJson([
            'message' => 'user unsubscribed successfully'
        ]);
    }
}
