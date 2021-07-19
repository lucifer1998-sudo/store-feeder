@extends('layouts.app')
@section('body')
    <form action="{{route('search-order')}}" method="POST">
        @csrf
        <div class="flex items-center border-b border-teal-500 py-2">
            <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 
            py-1 px-2 leading-tight focus:outline-none" type="text" 
            placeholder="Enter StoreFeeder Order ID" id="search-order" name="id" aria-label="Full name">
            <button class="flex-shrink-0 bg-blue-500 hover:bg-teal-700 border-teal-500 
            hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                Find
            </button>
        </div>
    </form>

    <form action="{{route('search-order')}}" method="POST">
        @csrf
        <div class="flex items-center border-b border-teal-500 py-2">
            <input type="hidden" name="channel" value="1">
            <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 
            py-1 px-2 leading-tight focus:outline-none" type="text" 
            placeholder="Enter Channel Order ID" id="search-order" name="id" aria-label="Full name">
            <button class="flex-shrink-0 bg-blue-500 hover:bg-teal-700 border-teal-500 
            hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                Find
            </button>
        </div>
    </form>
@endsection