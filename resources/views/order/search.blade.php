@extends('layouts.app')
@section('body')
    <h5 class="pb-4 mt-5 text-center">Find Orders by StoreFeeder Order Id Or Channel Order Id</h5>

    <form action="{{route('search-order')}}" method="POST" class="form">
        @csrf
        <div class="row">
            <div class="col-md-7 offset-md-2 p-0">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text"
                           placeholder="Enter StoreFeeder Order ID" id="search-order" name="id" aria-label="Full name">
                </div>
            </div>
            <div class="col-md-1 p-0">
                <div class="form-group">
                    <button class="btn btn-primary btn-lg ml-2 btn-block" type="submit">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form action="{{route('search-order')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7 offset-md-2 p-0">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text"
                           placeholder="Enter Channel Order ID" id="search-order" name="id" aria-label="Full name">
                </div>
            </div>
            <div class="col-md-1 p-0">
                <div class="form-group">
                    <button class="btn btn-outline-primary btn-lg ml-2 btn-block" type="submit">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
