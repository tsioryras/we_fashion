@if(!Route::is('login'))
    <footer class="page-footer font-small bg-dark text-white">
        @if(!Route::is('categories.*') && !Route::is('products.*') && !Route::is('admin') )
            @include('components.guest_footer')
        @endif
        <div class="footer-copyright text-center">
            <hr>
            <small> © 2020 Copyright
                <a href="https://tsioryras.eu">TsioryRas</a>
            </small>
        </div>
    </footer>
@endif