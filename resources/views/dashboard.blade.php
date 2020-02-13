@extends('layouts.app')

@section('content')
<div class="container">
    <section id="tickets" ref="tickets">
        <ticket v-for="(ticket,index) in tickets" :ticket="ticket" :key="index"></ticket>
    </section>
</div>
@endsection
