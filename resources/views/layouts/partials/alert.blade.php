@if(session()->has('message'))
        <div class="container-fluid">
                <div class="alert alert-{{session('message_type')}}">{{session('message')}}</div>
        </div>
    @endif