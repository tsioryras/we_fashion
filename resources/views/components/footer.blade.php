@if(!Route::is('login'))
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
        @guest

            <div class="container text-center">
                Links
            </div>
        @else
            <div class="container text-center">
                <small>Copyright &copy; We Fashion 2020</small>
                <br>
                <small> All rights reserved</small>
            </div>
        @endif
    </footer>
@endif