<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;
use App\Tag;
use App\TicketTag;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreTicket;
use App\Events\TicketEvent;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $tickets = Ticket::with('asker')->orderBy('created_at', 'desc')->get();
            return view('dashboard', ["tickets" => $tickets]);
        }

        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('ticket/create', ["tags" => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicket $request)
    {
        $validated = $request->validated();

        $ticket = new Ticket;
        $ticket->fill($validated);
        $ticket->asker()->associate(Auth::user());
        $ticket->save();

        $userAsk = User::find(Auth::user()->id);
        $userAsk->nbAsk = Auth::user()->nbAsk + 1;
        $userAsk->save();

        $tags = [];
        foreach ($request->all() as $field => $input) {
            if (preg_match("/tag-[A-z]+/i", $field)) {
                $tags[] = $input;
            }
        }
        $ticket->tags()->attach($tags);

        broadcast(new TicketEvent([$ticket]))->toOthers();

        return redirect('/ticket/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('ticket/show', ["ticket" => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $allTags = Tag::all();

        return view('ticket/edit', ["ticket" => $ticket, "allTags" => $allTags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTicket $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $validated = $request->validated();

        $ticket->fill($validated);
        $ticket->save();

        $tags = [];
        foreach ($request->all() as $field => $input) {
            if (preg_match("/tag-[A-z]+/i", $field)) {
                $tags[] = $input;
            }
        }
        $ticket->tags()->detach();
        $ticket->tags()->attach($tags);

        broadcast(new TicketEvent([$ticket]))->toOthers();

        return redirect('/');
    }


    public function updateTake(Request $request, Ticket $ticket)
    {

        if ($ticket->hasHelper() && Auth::user()->can('updateTake', $ticket)) {
            $ticket->helper()->dissociate();
            $ticket->save();
        } else {
            $ticket->helper()->associate(Auth::user());
            $ticket->save();
        }

        return redirect('/');
    }

    
    public function renewTicket(Request $request, Ticket $ticket)
    {
        $ticket->helper()->dissociate();
        $ticket->save();

        return redirect('/');
    }


    public function deleteEnd(Request $request, Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $morePoint = 10;
        $lessPoint = 2;

        $scoreAsker = $ticket->asker->scoreHelp;
        $scoreHelper = $ticket->helper->scoreHelp;

        $userAsk = User::find($ticket->asker->id);
        $userAsk->scoreHelp = $scoreAsker - $lessPoint;
        $userAsk->save();

        $userHelp = User::find($ticket->helper->id);
        $userHelp->scoreHelp = $scoreHelper + $morePoint;
        $userHelp->save();

        $ticket->delete();

        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        broadcast(new TicketEvent([], [$ticket]))->toOthers();

        $ticket->delete();

        return redirect('/');
    }

    public function data() {
        $update = [];
        foreach (Ticket::orderBy('created_at', 'DESC')->get() as $ticket) {
            $update[] = [
                "id" => $ticket->id,
                "title" => $ticket->title,
                "desc" => $ticket->desc,
                "asker" => [
                    "first_name" => $ticket->asker->first_name,
                    "last_name" => $ticket->asker->last_name,
                ]
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($update);
    }
}
