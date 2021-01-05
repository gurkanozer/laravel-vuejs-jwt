<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header dark-background text-light">Kategoriler</h5>
  <div class="card-body">
       @foreach ($categories as $category)
          <a href="/categories/"> {{$category->title}} </a>
          @if (!$loop->last)
              -
          @endif
       @endforeach
  </div>
</div>