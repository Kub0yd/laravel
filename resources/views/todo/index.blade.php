@extends('layouts.app')

@section('content')

    <div class="container">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="input-group mt-5">
                <span class="input-group-text">Наименование</span>
                <input type="text" name='title' class="form-control" placeholder="Наименование">
            </div>

            <div class="input-group mt-2">
                <span class="input-group-text">Постановщик задач</span>
                <select name="customer" class="form-select" aria-label="Default select menu">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                    {{-- <option selected>Open this select menu</option>

                    <option value="2">Two</option>
                    <option value="3">Three</option> --}}
                </select>
            </div>

            <div class="input-group mt-2">
                <span  class="input-group-text">Исполнители</span>
                <select name="executors[]" class="form-select" multiple aria-label="multiple select example">
                    @foreach ($users as $user)
                     <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                    {{-- <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option> --}}
                </select>
            </div>

            <div class="input-group mt-2">
                <span class="input-group-text">Задача</span>
                <textarea name="content" class="form-control" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group mt-2">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>

        <div class="input-group mt-5">
            <div class="row">
                @foreach ($tasks as $task)
                <div class="col-sm">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">{{$task->title}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$task->user->email}}</h6>
                            <p class="card-text">{{$task->content}}</p>
                            @foreach ($task->users as $executor)
                            <span class="card-link">{{$executor->email}}</span>
                            @endforeach
                            <form method="POST" action ="{{route('tasks.destroy', ['task' => $task->id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 mt-2 btn btn-primary">Удалить</button>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection
