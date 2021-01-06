<div class="post-container card">
  <a href="/{{$item->category->slug}}/{{$item->slug}}" class="post-image d-flex align-items-center"
    style="background-image: url({{asset("uploads/sneak/$item->img")}})">
    <h2 class="title">{{$item->title}}</h2>
  </a>
  <div class="card-body">

    <?= substr(json_decode($item->content),0,240)?>
    <br>
    <a href="/{{$item->category->slug}}/{{$item->slug}}" class="btn btn-outline-dark mt-2">Devamı &rarr;</a>
    <hr />
    <div class="post-info row">
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
</div>