<!-- Navigation -->
<navbar-component>
          <img class="rounded-circle" src='{{ asset("uploads/thumbnail/$settings->blog_logo") }}' width="30px" height="30px" alt="{{$settings->blog_name}}">
          <a class="navbar-brand ml-2" href="/">{{$settings->blog_name}}</a>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Ana Sayfa
                <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about">Hakkımda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contact">İletişim</a>
            </li>
          </ul>
</navbar-component>