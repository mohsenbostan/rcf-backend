<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function userNotifications()
    {
        return \response()->json(auth()->user()->unreadNotifications(), Response::HTTP_OK);
    }
}
