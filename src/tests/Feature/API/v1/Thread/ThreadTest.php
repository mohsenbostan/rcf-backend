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

    /** @test */
    public function create_thread_should_be_validated()
    {
        Sanctum::actingAs(factory(User::class)->create());

        $response = $this->postJson(route('threads.store'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_create_thread()
    {
        Sanctum::actingAs(factory(User::class)->create());

        $response = $this->postJson(route('threads.store'), [
            'title' => 'Foo',
            'content' => 'Bar',
            'channel_id' => factory(Channel::class)->create()->id
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /** @test */
    public function edit_thread_should_be_validated()
    {
        Sanctum::actingAs(factory(User::class)->create());
        $thread = factory(Thread::class)->create();

        $response = $this->putJson(route('threads.update', [$thread]), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function can_update_thread()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $thread = factory(Thread::class)->create([
            'title' => 'Foo',
            'content' => 'Bar',
            'channel_id' => factory(Channel::class)->create()->id,
            'user_id' => $user->id
        ]);

        $response = $this->putJson(route('threads.update', [$thread]), [
            'title' => 'Bar',
            'content' => 'Bar',
            'channel_id' => factory(Channel::class)->create()->id
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame('Bar', $thread->title);
    }

    /** @test */
    public function can_add_best_answer_id_for_thread()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $thread = factory(Thread::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->putJson(route('threads.update', [$thread]), [
            'best_answer_id' => 1,
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame('1', $thread->best_answer_id);
    }

    /** @test */
    function can_delete_thread()
    {
        $user = factory(User::class)->create();
        Sanctum::actingAs($user);

        $thread = factory(Thread::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->delete(route('threads.destroy', [$thread->id]));

        $response->assertStatus(Response::HTTP_OK);
    }
}
