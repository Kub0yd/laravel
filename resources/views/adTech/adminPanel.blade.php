@extends('layouts.app')

@section('content')
<div class='container'>
    <h3>Панель</h3>
    <div class="row">
        <div class='col offers-list'>
            @foreach ($offers as $offer)
            <p>{{$offer->title}}</p>
            @endforeach
        </div>
        <div class="col users-list">
            @foreach ($allUsers as $user)
            <p>{{$user->name}}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection
