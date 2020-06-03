@if(Session::get('message')!='')
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{Session::get('message') }}</strong>
    </div>
@endif