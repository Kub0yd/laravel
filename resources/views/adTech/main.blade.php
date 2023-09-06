@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
       New offer
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

