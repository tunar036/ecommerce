@if(count($errors)>0)
    <div class="alert-danger alert">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif