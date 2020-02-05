@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <button id="test">Notifier</button>
    @endauth
</div>
@endsection
