@if(Session::has('error'))
<div class = "alert alert-danger alert-dismissable">
    <button type= "button" class = "close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4> Error !</h4>
    {{ Session::get('error') }}
</div>
@endif

@if(Session::has('success'))
<div class = "alert alert-success alert-dismissable">
    <button type= "button" class = "close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4> Success !</h4>
    {{ Session::get('success') }}
</div>
@endif

