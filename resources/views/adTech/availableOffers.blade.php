<h3>Доступные предложения</h3>
<div class="input-group mt-5" >
    <div class="row offer-cards-panel">
        @foreach ($all_offers as $offer)
        <div class="col-sm">
            <div class="card border-dark mb-3" style="min-width: 200px;">
                <div class="card-header">
                    <div class="row">
                        <p class="text col" >{{$offer->title}}</p>
                        <p class="text-end col" id="offer-id-{{$offer->id}}">#{{$offer->id}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">{{$offer->URL}}</h6>
                    <p class="cart-text" >By: {{$offer->user->name}}</p>
                    <div class="row">
                        <button class="btn btn-primary col" id="offer-id-{{$offer->id}}-button" type="submit">Sub</button>
                        <p class="text-end col" >{{$offer->price}} &#8381</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
