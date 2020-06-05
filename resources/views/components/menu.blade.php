<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        @guest
            <a class="navbar-brand" href="{{ route('product_home') }}">
                {{strtoupper(config('app.name'))}}
            </a>
        @else
            <span class="navbar-brand">
                {{strtoupper(config('app.name'))}}
            </span>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            @guest
                @include('components.guest_nav')
            @else
                @if(Route::is('categories.*') || Route::is('products.*') || Route::is('admin') )
                    @include('components.admin_nav')
                @else
                    @include('components.guest_nav')
                @endif
            @endif
        </div>
    </div>
</nav>