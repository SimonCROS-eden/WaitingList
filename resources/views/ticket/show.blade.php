@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1>Show</h1>
        <p>{{ $ticket->asker->first_name }} {{ $ticket->asker->last_name }}</p>
        <h2>{{ $ticket->name }}</h2>
        <p>{{ $ticket->desc }}</p>

        @if ($ticket->asker == Auth::user() || Auth::user()->isAdmin())
            <a href="/ticket/{{$ticket->id}}/edit"><button type="button">Edit</button></a>
        
            <form action="{{ $ticket->id }}" method="post">
                @csrf
                @method("DELETE")
                <button type="submit">
                    Supprimer
                </button>
            </form>
        @endif

        <form action="/ticket/{{ $ticket->id }}/take" method="post">
                @csrf
                @method("PUT")
                @unless($ticket->helper)
                    <button type="submit" >
                        @can('updateTakeMaker', $ticket)
                            Pause
                        @else
                            Prendre
                        @endcan
                    </button>
                @else
                    @can('updateTake', $ticket)
                        <button type="submit">
                            @can('updateTakeMaker', $ticket)
                                Continue
                            @else
                                Abandonner
                            @endcan
                        </button>
                    @else
                        Pris par : {{$ticket->helper->last_name}} {{$ticket->helper->first_name}}
                    @endcan
                @endunless
            </form>
    @endauth
</div>
@endsection
