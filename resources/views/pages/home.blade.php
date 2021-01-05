@extends('layouts.master')
@section('content')
<div class="container row d-flex justify-content-center">
<div class="col-md-8">
        @foreach ($posts as $item)
            @include('components.postSneak')
        @endforeach
</div>
<div class="col-md-4">
    @include('components.searchWidget')
    @include('components.categoriesWidget')
</div>
</div>
@endsection