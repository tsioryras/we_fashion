<ul class="navbar-nav mr-auto">
    @if(Route::has('login')==false)
        <li class="nav-item">
            <a class="nav-link" href="">{{strtoupper('soldes')}}</a>
        </li>
        @forelse($categories as $category)
            <li class="nav-item">
                <a class="nav-link"
                   href="{{route('category',['category'=>$category->name])}}">{{strtoupper($category->name)}}</a>
            </li>
        @empty
        @endforelse
    @endif
</ul>