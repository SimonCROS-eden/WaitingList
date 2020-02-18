@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <p>{{ $ticket->asker->first_name }} {{ $ticket->asker->last_name }}</p>
                    <h2 class="text-primary">{{ $ticket->title }}</h2>
                    <div class="form-group col p-0">
                        @foreach ($ticket->tags as $tag)
                            <span style="background-color: {{ $tag->color }}" class="badge px-3 py-2 text-white my-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>

                    <hr />
                    <pre class="text">{{ $ticket->desc }}</pre>

                    <div class="col">
                        <div class="row">
                            @if ($ticket->asker == Auth::user() || Auth::user()->isAdmin())
                                <a href="/ticket/{{$ticket->id}}/edit"><button class="btn btn-primary mr-2 mt-2" type="button">Modifier</button></a>
                                @unless($ticket->helper)
                                    <form action="/ticket/{{ $ticket->id }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-primary mr-2 mt-2" type="submit">
                                            Supprimer
                                        </button>
                                    </form>
                                @else
                                    @if($ticket->ask_id === $ticket->help_id)
                                        <form action="/ticket/{{ $ticket->id }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-primary mr-2 mt-2" type="submit">
                                                Supprimer
                                            </button>
                                        </form>
                                    @else
                                        <form action="/ticket/{{ $ticket->id }}/end" method="post">
                                            @csrf
                                            <button class="btn btn-primary mr-2 mt-2" type="submit">
                                                Finir
                                            </button>
                                        </form>
                                        <form action="/ticket/{{ $ticket->id }}/renew" method="post">
                                            @csrf
                                            <button class="btn btn-primary mr-2 mt-2" type="submit">
                                                Renouveller
                                            </button>
                                        </form>
                                    @endif
                                @endunless
                            @endif

                            <form action="/ticket/{{ $ticket->id }}/take" method="post">
                                @csrf
                                @method("PUT")
                                @unless($ticket->helper)
                                    <button class="btn btn-primary mt-2" type="submit" >
                                        @can('updateTakeMaker', $ticket)
                                            Pause
                                        @else
                                            Prendre
                                        @endcan
                                    </button>
                                @else
                                    @can('updateTake', $ticket)
                                        <button class="btn btn-primary mt-2" type="submit">
                                            @can('updateTakeMaker', $ticket)
                                                Continue
                                            @else
                                                Abandonner
                                            @endcan
                                        </button>
                                    @else
                                        <p class="text-primary mt-2">
                                            @if($ticket->ask_id === $ticket->help_id)
                                                Le ticket est mit en pause ...
                                            @else
                                                Pris par : {{$ticket->helper->last_name}} {{$ticket->helper->first_name}}
                                            @endif
                                        </p>
                                    @endcan
                                @endunless
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
