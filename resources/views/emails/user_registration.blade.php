<h1>{{config('app.name')}}</h1>
<p>Salam {{$user->name}}, Qeydiyyatınız uğurla həyata keçirildi</p>
<p>
    Qeydiyyatınızı aktivləşdirmək üçün 
    <a href="{{config('app.url')}}/user/activate/{{$user->activation_key}}">klikləyin</a>
    və ya brauzerinizdə aşağıdakı linki açın
</p>
<p>{{config('app.url')}}/user/activate/{{$user->activation_key}}</p>