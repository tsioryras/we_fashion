<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="">{{strtoupper('produits')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">{{strtoupper('categories')}}</a>
    </li>

</ul>
<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ucfirst(trans(Auth::user()->name ))}} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>