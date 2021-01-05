@extends('layouts.master')
@section('content')
<div class="container my-4 row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <div class="card-body">
                <h3 class="card-title">{{$page->display_name}}</h3>
                <hr/>
                {{$page->content}}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('components.searchWidget')
        @include('components.categoriesWidget')
    </div>
</div>
@endsection