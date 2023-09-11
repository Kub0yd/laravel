<h3>Доступные предложения</h3>
<div class="input-group mt-5" >
    <div class="row offer-cards-panel">
        @foreach ($all_offers as $offer)
        <div class="col-sm">
            <div class="card border-dark mb-3" style="min-width: 220px;">
                <form method="POST" action="{{ route('main.store') }}">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <p class="text col" >{{$offer->title}}</p>
                            <p class="text-end col for-control" name="offer_id" id="offer-id-{{$offer->id}}">#{{$offer->id}}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">{{$offer->URL}}</h6>
                        <p class="cart-text" >By: {{$offer->user->name}}</p>
                        <div class="row">
                            @if (Auth::user()->subs()->where('offer_id', $offer->id)->where('is_active', true)->get()->count())
                            <button class="btn btn-secondary col" id="offer-id-{{$offer->id}}-button" type="submit">Отписаться</button>
                            <input type="hidden" name="subscription" value='unsubscribe'>
                            <input type="hidden" name="offer_id" value="{{$offer->id}}">
                            @else
                            <button class="btn btn-primary col" id="offer-id-{{$offer->id}}-button" type="submit">Sub</button>
                            <input type="hidden" name="subscription" value='subscribe'>
                            <input type="hidden" name="offer_id" value="{{$offer->id}}">
                            @endif
                            <p class="text-end col" >{{$offer->price}} &#8381</p>
                        </div>
                    </div>
                    <div class="card-footer text-muted offer-{{$offer->id}}-subs">
                        Подписок: {{$offer->subs->where('is_active', true)->count()}}
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
