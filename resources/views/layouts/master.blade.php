<!DOCTYPE html>
<html lang="en">
@include('layouts/head')
<body>
    <div id="app">
        @include('layouts/navbar')
        @include('layouts/banner')
        <div class="container row m-auto">
            @include('components/searchFixed')
            <div class="col-md-8">
                @yield('content')
            </div>
            <div class="col-md-4">
                @include('components.searchWidget')
                @include('components.categoriesWidget')
            </div>
            </div>
        @include('layouts/footer')
    </div>
    <script src="{{ mix('frontend/js/app.js') }}"></script>
</body>
</html>