<?php


namespace App\Repositories;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ThreadRepository
{

    public function getAllAvailableThreads()
    {
        return Thread::whereFlag(1)->latest()->get();
    }

    public function getThreadBySlug($slug)
    {
        return Thread::whereSlug($slug)->whereFlag(1)->first();
    }
}
