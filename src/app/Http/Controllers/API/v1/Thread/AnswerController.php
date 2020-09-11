<?php

namespace App\Http\Controllers\API\v1\Thread;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Notifications\NewReplySubmitted;
use App\Repositories\AnswerRepository;
use App\Repositories\SubscribeRepository;
use App\Repositories\UserRepository;
use App\Subscribe;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user-block'])->except([
            'index',
        ]);
    }

    public function index()
    {
        $answers = resolve(AnswerRepository::class)->getAllAnswers();

        return response()->json($answers, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'thread_id' => 'required',
        ]);

        // Insert Data Into DB
        resolve(AnswerRepository::class)->store($request);

        // Get List Of User Id Which Subscribed To A Thread Id
        $notifiable_users_id = resolve(SubscribeRepository::class)->getNotifiableUsers($request->thread_id);
        // Get User Instance From Id
        $notifiable_users = resolve(UserRepository::class)->find($notifiable_users_id);
        // Send NewReplySubmitted Notification To Subscribed Users
        Notification::send($notifiable_users, new NewReplySubmitted(Thread::find($request->thread_id)));

        // Increase User Score
        if (Thread::find($request->input('thread_id'))->user_id !== auth()->id()) {
            auth()->user()->increment('score', 10);
        }

        return \response()->json([
            'message' => 'answer submitted successfully'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'content' => 'required',
        ]);

        if (Gate::forUser(auth()->user())->allows('user-answer', $answer)) {
            resolve(AnswerRepository::class)->update($request, $answer);

            return \response()->json([
                'message' => 'answer updated successfully'
            ], Response::HTTP_OK);
        }

        return \response()->json([
            'message' => 'access denied'
        ], Response::HTTP_FORBIDDEN);
    }

    public function destroy(Answer $answer)
    {
        if (Gate::forUser(auth()->user())->allows('user-answer', $answer)) {
            resolve(AnswerRepository::class)->destroy($answer);

            return \response()->json([
                'message' => 'answer deleted successfully'
            ], Response::HTTP_OK);
        }

        return \response()->json([
            'message' => 'access denied'
        ], Response::HTTP_FORBIDDEN);
    }
}
