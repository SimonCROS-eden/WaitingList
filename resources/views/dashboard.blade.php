@extends('layouts.app')

@section('content')
<div class="container">
    <section id="tickets" ref="tickets">
        <ticket v-for="(ticket,index) in tickets" :ticket="ticket" key="index"></ticket>
        {{-- @foreach ($tickets as $ticket)
            <ticket :ticket="{{ $ticket->toJson() }}"></ticket>
        @endforeach --}}
    </section>
</div>
@endsection
