<ul class="navbar-nav mr-auto">
    @if(Route::has('login')==false || Route::is('product*'))
        <li class="nav-item">
            <a class="nav-link active" href="{{route('product_code','onSale')}}">
                {{strtoupper('soldes')}}
            </a>
        </li>
        @forelse($categories as $category)
            <li class="nav-item">
                <a class="nav-link" href="{{route('product_category',['category'=>$category])}}">
                    {{strtoupper($category)}}
                </a>
            </li>
        @empty
        @endforelse
    @endif
</ul>