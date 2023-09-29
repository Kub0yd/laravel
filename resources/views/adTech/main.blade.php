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

    @include('adTech.modals.createOffer')

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
        @include('adTech.modals.usersOfferStat')
        
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

