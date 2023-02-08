<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;

class ShopController extends Controller
{
    public function __construct(UserRepo $user, MessageRepo $message_repo)
    {
        $this->user = $user;
        $this->message_repo = $message_repo;
        // $this->middleware('teamSA', ['except' => ['verify', 'enter_pin'] ]);
    }

    public function index()
    {
        $d['user'] = $this->user;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        return view('pages.support_team.shop.index', $d);
    }
}
