@include('admin.partials.top-of-page-admin')

<div class="row">
    <div class="col-md-2 well">
        <p class="text-center"><strong>Navigation</strong></p>
        @include('admin.partials.nav')
    </div>
    <div class="col-md-10">
        <h1>@yield('title')</h1>
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('admin.partials.bottom-of-page-admin')
