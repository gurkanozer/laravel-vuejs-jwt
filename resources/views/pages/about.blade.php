@extends('layouts.master')
@section('content')
        <div class="card p-4 mt-4">
            <div class="card-body">
                <h3 class="card-title">{{$page->display_name}}</h3>
                <hr/>
                {{$page->content}}
            </div>
        </div>
@endsection