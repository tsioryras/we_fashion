@if(!Route::is('login'))
    <footer class="page-footer font-small bg-dark pt-4 text-white">
        @if(!Route::is('categories.*') && !Route::is('products.*') && !Route::is('admin') )
            @include('components.guest_footer')
        @endif
        <div class="footer-copyright text-center py-3">© 2020 Copyright
            <a href="https://tsioryras.eu">TsioryRas</a>
        </div>
    </footer>
@endif