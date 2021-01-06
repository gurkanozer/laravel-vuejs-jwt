<!-- Categories Widget -->
<div class="widget">
  <div class="card">
    <h5 class="card-header dark-background text-light">Kategoriler</h5>
    <div class="card-body">
      @foreach ($categories as $category)
      <a href="/category/{{$category->slug}}"> {{$category->title}} </a>
      @if (!$loop->last)
      -
      @endif
      @endforeach
    </div>
  </div>
</div>