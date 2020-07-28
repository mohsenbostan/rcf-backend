<?php

namespace Tests\Feature\API\v1\Thread;

use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    /** @test */
    public function all_threads_list_should_be_accessible()
    {
        $response = $this->get(route('threads.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function thread_should_be_accessible_by_slug()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get(route('threads.show', [$thread->slug]));

        $response->assertStatus(Response::HTTP_OK);
    }
}
