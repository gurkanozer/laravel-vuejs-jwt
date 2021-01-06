@extends('layouts.master')
@section('content')
    @foreach ($posts as $item)
        @include('components.postContainer')
    @endforeach
@endsection