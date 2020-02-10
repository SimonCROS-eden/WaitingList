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

    public function index($title, $description = "") {
        $event = new TestEvent([[
            "id" => 1,
            "title" => $title,
            "description" => $description
        ]]);
        broadcast($event)->toOthers();
        dd();
    }
}
