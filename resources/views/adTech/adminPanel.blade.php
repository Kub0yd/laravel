@extends('layouts.adminApp')

@section('content')
<div class='container'>
    <h3>Панель</h3>
    <div class="row">
        <div class='col offers-list'>

            {{-- <div  class='border border-2 border-secondary bg-dark bg-gradient text-white'>
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
                            <div class="row offer-{{$offer->id}}-subs">
                                <div class='col'>
                                    Subs: {{$offer->subs->where('is_active', tdue)->count()}}
                                </div>

                            </div>
                            <div class="row"  id="offer-loss">
                                <div class='col'>
                                    <span class="text-end col" id="offer-income">Расход {{Auth::user()->tdansactions->where('offer_id', $offer->id)->sum('cost') *0.8}}&#8381</span>
                                </div>

                            </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div  class='border border-2 border-secondary bg-dark bg-gradient text-white'> --}}
                <!-- Modal -->
                <div class="modal fade" id="offer-control" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Statistic</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>

                            <div class="modal-body">
                                <div class='card'>
                                    <div class='row'>
                                        <div class='col-sm-1'>
                                            id
                                        </div>
                                        <div class='col-md-2'>
                                            User
                                        </div>
                                        <div class='col-auto'>
                                            https://sdsdsdsdjjjflsafjafjalfjasfasfj
                                        </div>
                                        <div class='col'>
                                            income
                                        </div>
                                        <div class='col'>
                                            <div class='row'>
                                                <div class='col'>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                         webmaster
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class='col'>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                          admin
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class='col'>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                          creator
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-sm table-bordered table-dark table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Id</th>
                          <th scope="col">Creator</th>
                          <th scope="col">Title</th>
                          <th scope="col">URL</th>
                          <th scope="col">Link price</th>
                          <th scope="col">All Subs</th>
                          <th scope="col">Loss</th>
                        </tr>
                      </thead>
                    <tbody>
                        @foreach ($offers as $offer)

                        <tr class="table-dark">
                            <th scope="row">
                                <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                            </th>
                            <td>
                                <span class='offer-id'>#{{$offer->id}}</span>
                            </td>
                            <td>
                                <span class="creator" >{{$offer->user->name}}</span>
                            </td>
                            <td>
                                <span class="cart-text" >{{$offer->title}}</span>
                            </td>
                            <td>
                                <a href="{{$offer->URL}}" class="">{{$offer->URL}}</a>
                            </td>
                            <td>
                                <span>{{$offer->price}} &#8381</span>
                            </td>
                            <td>
                                <span>{{$offer->subs->count()}}</span>
                            </td>
                            <td>
                                {{$offer->transactions->sum('cost')}}&#8381
                            </td>
                        </tr>
                        <tr class="table-dark">
                            <td>
                            </td>
                            <td colspan="3">
                                <button type="button" class="btn btn-sm btn-primary modal-act" data-bs-toggle="modal" data-bs-target="#offer-control">
                                    Управление
                                 </button>
                            </td>
                            <td colspan="3">
                            </td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            {{-- </div> --}}

        </div>
        <div class="col users-list">
            @foreach ($allUsers as $user)
            <p>{{$user->name}}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        var userId  = {{ Js::from(Auth::id())}};
    </script>
    <script src="/js/admin.js"></script>
    {{-- @vite(['public/js/main.js']) --}}
@endsection
