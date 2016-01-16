@include('partials.top-of-page')

@yield('slider')

<div class="container pushdown">
    <divc class="row">
        <div class="col-md-12">
            <h1 class="pushdown-title">@yield('page-title')</h1>
            @yield('page-content')
        </div>
    </divc>
</div>

@include('partials.bottom-of-page')