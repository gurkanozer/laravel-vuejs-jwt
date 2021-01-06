@extends('layouts.master')
@section('content')
<div class="post-container">
    <h1>{{$item->title}}</h1>
    <hr />
    <?= json_decode($item->content)?>
    <hr />
    <div class="post-info row d-flex align-items-center justify-content-start">
            <div class="col-md-8">
                <img src="/uploads/thumbnail/{{$item->user->img}}" class="icon" alt="{{$item->user->img}}">
                <a class="author" href="/author/{{$item->user->full_name}}">{{$item->user->full_name}}</a>
                <a class="category" href="/category/{{$item->category->slug}}">{{$item->category->title}}</a>
            </div>
            <div class="col-md-4 d-flex">
                <p class="ml-auto">Tarih: {{date('d-m-Y',strtotime($item->updated_at))}} </p>
            </div>
            <div class="tags ml-auto">
                @if (count($item->tag)>0)
                Etiketler:
                @foreach ($item->tag as $tag)
                <span class="badge badge-pill badge-primary">{{$tag->title}}</span>
                @endforeach
                @endif
              </div>
    </div>
</div>
@endsection