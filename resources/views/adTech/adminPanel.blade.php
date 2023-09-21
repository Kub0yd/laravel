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
                                <div class='row'>
                                    <div class="col">
                                        <h3>Подписчики</h3>
                                        <table  class="table table-sm  table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Webmaster URL</th>
                                                    <th scope="col">All time income value</th>
                                                    <th scope="col" colspan='3'>Roles</th>
                                                </tr>
                                            </thead>
                                            <tbody class='offer-user-info'>
                                                <tr >
                                                    <th scope="row">
                                                        <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                                            <circle cx="8" cy="8" r="8"/>
                                                        </svg>
                                                    </th>
                                                    <td>
                                                        <span class='offer-id'>#12</span>
                                                    </td>
                                                    <td>
                                                        <span class="creator" >Test</span>
                                                    </td>
                                                    <td>
                                                        <a href="http://localhost/admin" class="">http://localhost/admin</a>
                                                    </td>
                                                    <td>
                                                        <span>1 &#8381</span>
                                                    </td>
                                                    <td>
                                                        <span>Webmaster, Admin, Creator</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="user-control" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Statistic</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <h5>User offers</h5>
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Webmaster URL</th>
                                                    <th scope="col">Total income</th>
                                                    <th scope="col" colspan='3'>User roles</th>
                                                </tr>
                                                </thead>
                                        </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5>User Role</h5>
                                        <div class='row roles-checkbox'>
                                            <div class='col'>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                     webmaster
                                                    </label>
                                                </div>
                                            </div>
                                            <div class='col'>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                      admin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class='col'>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                      creator
                                                    </label>
                                                </div>
                                            </div>
                                            <div class='col'>
                                                <button type="button" class="btn btn-sm btn-secondary" id="post-user-role">Save</button>
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
                                    Статистика
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
                {{ $offers->links() }}
            {{-- </div> --}}

        </div>
        <div class="col users-list">
            <div class="overflow-auto">
                @foreach ($allUsers as $user)
                <div class="row">
                    <div class="col">
                        <p>{{$user->name}}</p>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-sm btn-primary modal-act" data-bs-toggle="modal" data-bs-target="#user-control">
                            Управление
                         </button>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            {{ $allUsers->links() }}
        </div>
    </div>
</div>
@include('adTech.adminStat')
@endsection

@section('scripts')
    <script>
        var userId  = {{ Js::from(Auth::id())}};
    </script>
    <script src="/js/admin.js"></script>
    {{-- @vite(['public/js/main.js']) --}}
@endsection
