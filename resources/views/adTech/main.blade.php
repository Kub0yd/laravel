@extends('layouts.app')

@section('content')
<div class='container'>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
       New offer
    </button> --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('main.store') }}">
                        @csrf
                        <div class="input-group mt-5">
                            <span class="input-group-text">Title</span>
                            <input type="text" name='title' class="form-control" placeholder="Title">
                        </div>

                        <div class="input-group mt-2">
                            <span class="input-group-text">Your website page URL</span>
                            <input type="text" name='URL' class="form-control" placeholder="https://yoursite.com/page/product">
                        </div>

                        <div class="input-group mt-2">
                            <span class="input-group-text">Price per click</span>
                            <input type="number" name='price' class="form-control" value='1' placeholder="">
                        </div>


                        <div class="input-group mt-2">
                            <button id="button" type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <h3>Ваши предложения</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        New offer
     </button>
    <div class="input-group mt-5">
        <div class="row">
            @foreach ($offers as $offer)
            <div class="col-sm">
                <fieldset>
                <div class="card border-dark mb-3" style="min-width: 220px;">
                    <div class="card-header">
                        <div class="row">
                            <p class="text col" >{{$offer->title}}</p>
                            <p class="text-end col my-offer" id="offer-id-{{$offer->id}}">#{{$offer->id}}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{$offer->URL}}" class="card-subtitle mb-2 text-muted">{{$offer->URL}}</a>
                        <div class="row">
                            <p class="text col-5" >{{$offer->price}} &#8381</p>
                            <div class="form-check form-switch col-1">
                                @if ($offer->is_active)
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                @else
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                @endif
                                <label class="form-check-label" for="flexSwitchCheckDefault">Активность</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted offer-{{$offer->id}}-subs">
                        Подписок: {{$offer->subs->where('is_active', true)->count()}}
                    </div>
                </div>
                </fieldset>
            </div>
            @endforeach
        </div>
    </div>
    @include('adTech.availableOffers')
</div>
@endsection
@section('scripts')
    <script src="/js/main.js"></script>
@endsection

