<div class="card mb-4">
    <img class="card-img-top" src="{{asset("uploads/sneak/$item->img")}}" alt="Card image cap">
    <div class="card-body">
      <h2 class="card-title">{{$item->title}}</h2>
      <p class="card-text">{{$item->content}}</p>
      <a href="post/" class="btn btn-outline-dark">Devamı &rarr;</a>
    </div>
    <div class="px-3 pb-4 text-muted">
      Created At
      <a href="/categories/">{{$item->category->title}}</a>,
      <a href="/about">{{$item->user->full_name}}</a>
    </div>
  </div>