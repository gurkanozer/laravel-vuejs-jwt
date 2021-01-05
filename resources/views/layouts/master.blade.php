<!DOCTYPE html>
<html lang="en">
@include('layouts/head')
<body>
    <div id="app">
        @include('layouts/navbar')
        @include('layouts/banner')
        @yield('content')
        @include('layouts/footer')
    </div>
    <script src="{{ mix('frontend/js/app.js') }}"></script>
</body>

</html>