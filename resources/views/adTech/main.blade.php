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
    @if (Auth::user()->hasPermissions('can_create_offers'))
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


    <h3  class="title">Ваши предложения</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        New offer
    </button>

    <div class="row">
        @foreach ($offers as $offer)
        <div class="container rounded-pill border border-2 border-secondary bg-dark bg-gradient text-white offer-card-id-{{$offer->id}}">
            <div class="row align-items-center ">
                <div class="col-sm-auto">
                    <div class="row align-items-center">
                        <div class="col">
                            @if ($offer->is_active)
                                <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                            @else
                                <svg class='offer-indicator inactive-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                            @endif
                        </div>
                        <div class="col offer-id"  id="offer-id-{{$offer->id}}">
                            #{{$offer->id}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-auto">
                    {{$offer->title}}
                </div>
                <div class="col-lg-auto">
                    <a href="{{$offer->URL}}" class="">{{$offer->URL}}</a>
                </div>
                <div  class="col-sm-auto">
                    <span>Price per redirect: {{$offer->price}} &#8381</span>
                </div>
                <div class="col-lg order-12 d-flex justify-content-end">
                    <div class="row align-items-center offer-{{$offer->id}}-subs-row">
                        <div class="col-auto offer-statistic-button">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#offer-{{$offer->id}}-statistic">
                                Statis
                                </button>
                        </div>
                        <div class="col-auto offer-{{$offer->id}}-subs">
                            Subs: {{$offer->subs->where('is_active', true)->count()}}
                        </div>
                        <div class="col-auto"  id="offer-loss">
                            Расход: {{$offer->transactions->sum('cost')}}&#8381
                        </div>
                        <div class="col-sm order-12 d-flex justify-content-end">
                            <div class="form-check form-switch">
                            @if ($offer->is_active)
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                            @else
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            @endif
                                <label class="form-check-label" for="flexSwitchCheckDefault">Активность</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Modal -->
        <div class="modal fade " id="offer-{{$offer->id}}-statistic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Statistic</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>

                    <div class="modal-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Период</th>
                                <th scope="col">Расходы</th>
                                <th scope="col">Переходы</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">День</th>
                                <td class="loss-stat loss-day">{{$offer->transactions->where('created_at', '>=', now()->format('Y-m-d'))->where('created_at', '<', now()->addDay()->format('Y-m-d'))->sum('cost')}}</td>
                                <td class="transitions-stat transitions-day">{{$offer->transactions->where('created_at', '>=', now()->format('Y-m-d'))->where('created_at', '<', now()->addDay()->format('Y-m-d'))->count()}}</td>

                            </tr>
                            <tr>
                                <th scope="row">Месяц</th>
                                <td class="loss-stat loss-month">{{$offer->transactions->where('created_at', '>=', now()->firstOfMonth()->format('Y-m-d'))
                                    ->where('created_at', '<', now()->addMonth()->firstOfMonth()->format('Y-m-d'))
                                    ->sum('cost')}}
                                </td>
                                <td class="transitions-stat transitions-month">{{$offer->transactions->where('created_at', '>=', now()->firstOfMonth()->format('Y-m-d'))
                                    ->where('created_at', '<', now()->addMonth()->firstOfMonth()->format('Y-m-d'))
                                    ->count()}}
                                </td>

                            </tr>
                            <tr>
                                <th scope="row">Год</th>
                                <td class="loss-stat loss-year">{{$offer->transactions->where('created_at', '>=', now()->firstOfYear()->format('Y-m-d'))
                                    ->where('created_at', '<', now()->addYear()->firstOfYear()->format('Y-m-d'))
                                    ->sum('cost')}}
                                </td>
                                <td class="transitions-stat transitions-year">{{$offer->transactions->where('created_at', '>=', now()->firstOfYear()->format('Y-m-d'))
                                    ->where('created_at', '<', now()->addYear()->firstOfYear()->format('Y-m-d'))
                                    ->count()}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <h3  class="title">Подписки</h3>
@if (Auth::user()->hasPermissions('sub_offers'))
    @include('adTech.sublist')
    @include('adTech.availableOffers')
@endif
</div>
@endsection
@section('scripts')
    <script>
        var userId  = {{ Js::from(Auth::id())}};
    </script>
    <script src="/js/main.js"></script>
    {{-- @vite(['public/js/main.js']) --}}
@endsection

