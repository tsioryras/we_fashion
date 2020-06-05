<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{route('products.index')}}">
            {{strtoupper('produits')}}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('categories.index')}}">
            {{strtoupper('categories')}}
        </a>
    </li>

</ul>
<ul class="navbar-nav ml-auto admin-icons">
    <li class="nav-item">
        <a class="nav-link" title="aller vers le site" href="{{ route('product_home') }}">
            <i class="fa fa-globe"></i>
        </a>
    </li>
    <li class="nav-item">
        <span class="nav-link">
            <i class="fa fa-user"></i> {{ucfirst(trans(Auth::user()->name ))}}
        </span>
    </li>
    <li class="nav-item">
        <a class="nav-link" title="se déconnecter" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
    </li>
</ul>