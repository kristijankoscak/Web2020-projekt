
@if(session('success'))
<div class="container">
    <div class="alert alert-success" id="messageBlock">
        {{session('success')}}
    </div>
</div>
    
@endif

@if(session('error'))
<div class="container">
    <div class="alert alert-danger" id="messageBlock">
        {{session('error')}}
    </div>
</div>
@endif