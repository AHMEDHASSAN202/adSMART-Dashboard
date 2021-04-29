<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        app('document')->setTitle(_e('chat'));

        return Inertia::render('Chat/Index', ['activeId' => 'chat']);
    }

    public function chatGroupsIndex()
    {
        app('document')->setTitle(_e('chat_groups'));

        return Inertia::render('Chat/Groups/Index', ['activeId' => 'chat_groups']);
    }
}
