@include('layouts._partials.header')
@auth
@include('layouts._partials.navbar')
@endauth
<!-- Main Content -->
<div class="main-content">
    <section class="section">
    <div class="section-header">
        <h1>{{ $title ?? '' }}</h1>
    </div>

    <div class="section-body">
        @yield('content')
    </div>
    </section>
</div>
@include('layouts._partials/footer')


