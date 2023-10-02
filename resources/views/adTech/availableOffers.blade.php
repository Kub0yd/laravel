<h3 class="title">Доступные предложения</h3>
{{-- <div class="input-group mt-5" > --}}
<div class='container offers-list'>
        @foreach ($allOffers as $offer)
        <div class="row offer-cards-panel">
            <div class="container rounded-pill border border-2 border-secondary bg-dark bg-gradient text-white offer-card-id-{{$offer->id}}">
                <div class="row align-items-center ">
                    <div class="col-sm-auto">
                        <div class="row align-items-center">
                            <div class="col">
                                <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                            </div>
                            <div class="col offer-id"  id="offer-id-{{$offer->id}}">
                                #{{$offer->id}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <span class="cart-text" >By: {{$offer->user->name}}</span>
                    </div>
                    <div class="col-lg-auto">
                        {{$offer->title}}
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{$offer->URL}}" class="">{{$offer->URL}}</a>
                    </div>
                    <div  class="col-sm-auto">
                        <span>Price: {{$offer->price}} &#8381</span>
                    </div>
                    <div class="col-lg order-12 d-flex justify-content-end">
                        <div class="row align-items-center offer-{{$offer->id}}-subs-row">
                            <div class="col-auto offer-statistic-button">
                                <button type="button" class="btn  btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#offer-{{$offer->id}}-statistic">
                                    Статистика
                                 </button>
                            </div>
                            <div class="col-auto offer-{{$offer->id}}-subs">
                                Subs: {{$offer->subs->where('is_active', true)->count()}}
                            </div>
                            <div class="col-auto"  id="offer-loss">
                                <span class="text-end col" id="offer-income">Доход: {{Auth::user()->transactions->where('offer_id', $offer->id)->sum('cost') *0.8}}&#8381</span>
                            </div>
                            @if (Auth::user()->subs()->where('offer_id', $offer->id)->where('is_active', true)->get()->count())
                            <div class="col-sm order-12 d-flex justify-content-end offer-subscribe">
                                <button class="btn btn-sm btn-secondary" id="offer-id-{{$offer->id}}-button" type="submit">Отписаться</button>
                                <input class='button-value' type="hidden" name="subscription" value='unsubscribe'>
                                <input type="hidden" name="offer_id" value="{{$offer->id}}">
                            </div>
                            @else
                            <div class="col-sm order-12 d-flex justify-content-end offer-subscribe">
                                <button class="btn btn-sm btn-primary sub-button col" id="offer-id-{{$offer->id}}-button" type="submit">подписаться</button>
                                <input type="hidden" name="subscription" value='subscribe'>
                                <input type="hidden" name="offer_id" value="{{$offer->id}}">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if (Auth::user()->subs()->where('offer_id', $offer->id)->where('is_active', true)->get()->count())
                <div class="row justify-content-around">
                    <div class="col-auto">
                        <span>Разместите на своем сайте:
                            <a href="{{ Auth::user()->subs()->where('offer_id', $offer->id)->value('link') }}" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                {{ Auth::user()->subs()->where('offer_id', $offer->id)->value('link') }}
                            </a>
                        </span>
                    </div>
                </div>
                @endif

            </div>
            <!-- Modal -->
            @include('adTech.modals.allOffersStat')
        </div>
    @endforeach
</div>
