@extends('layouts.adminApp')

@section('content')
<div class='container'>
    <h3>Доход системы: {{$transactions->sum('cost') * 0.2}}₽</h3>
    <div class="row">
        <div class='col offers-list'>
            <!-- Modal -->
            @include('adTech.modals.adminOfferStat')
            {{-- END MODAL --}}
            <!-- Modal -->
            @include('adTech.modals.adminOfferErrors')
            {{-- END MODAL --}}
            <!-- Modal -->
            @include('adTech.modals.adminUserPanel')
            {{-- END MODAL --}}
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
                <tbody class="offers-table">
                    @foreach ($offers as $offer)

                    <tr class="table-dark offer-id-{{$offer->id}} offer-line" >
                        <th scope="row">
                            @if ($offer->is_active)
                            <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                <circle cx="8" cy="8" r="8"/>
                            </svg>
                            @else
                            <svg class='offer-indicator disabled-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                <circle cx="8" cy="8" r="8"/>
                            </svg>
                            @endif

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
                            <span class="offer-subs">{{$offer->subs->count()}}</span>
                        </td>
                        <td class="loss-val">
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
                        <td colspan="2">
                        </td>
                        <td colspan="2">
                            <button type="button" class="btn btn-sm btn-danger modal-act errors" data-bs-toggle="modal" data-bs-target="#attempts-error">
                                ошибки переходов
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col users-list" style="color: white">
            <div class="overflow-auto">
                @foreach ($allUsers as $user)
                <div class="row">
                    <div class="col">
                        <span class="user-id">{{$user->id}}</span>
                    </div>
                    <div class="col user-name">
                        <p>{{$user->name}}</p>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-sm btn-primary user-modal-act" data-bs-toggle="modal" data-bs-target="#user-control">
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

@endsection

@section('scripts')
    <script>
        var userId  = {{ Js::from(Auth::id())}};
    </script>
    <script src="/js/admin.js"></script>
    {{-- @vite(['public/js/main.js']) --}}
@endsection
