<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestController extends Controller
{
    public function index() {
        $event = new TestEvent(["name" => "Titre"]);
        event($event);
        dd();
    }
}
