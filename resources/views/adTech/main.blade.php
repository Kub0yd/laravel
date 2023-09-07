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
                <div class="card border-dark mb-3">
                    <div class="card-header">{{$offer->title}}</div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">{{$offer->URL}}</h6>
                        <p class="card-text">{{$offer->price}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <h3>Доступные предложения</h3>
    <div class="input-group mt-5" >
        <div class="row">
            @foreach ($all_offers as $offer)
            <div class="col-sm">
                <div class="card border-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$offer->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$offer->URL}}</h6>
                        <div class="row">
                            <p class="text-end col" >{{$offer->price}}</p>
                            <div class="form-check form-switch col">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Отключить</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

