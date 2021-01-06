<!-- Full Page Image Header with Vertically Centered Content -->
<header class="masthead" style="background-image: url({{asset("uploads/banner/$page->img")}})">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
        @if ($page->message)
        <h1 class="title">{{$page->message}}</h1>            
        @endif
      </div>
    </div>
  </div>
</header>