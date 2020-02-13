@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>Tags</h1>
        <ul>
            @foreach ($tags as $tag)
                <li style="color: {{$tag->color}}">{{ $tag->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
