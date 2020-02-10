<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id, $title, $user, $description = "") {
        $event = new TestEvent([[
            "id" => $id,
            "title" => $title,
            "user" => $user,
            "description" => $description
        ]]);
        broadcast($event)->toOthers();
        dd();
    }
}
