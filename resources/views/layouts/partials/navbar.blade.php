<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="/img/logo.png">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" action="{{route('search_product')}}" method="get">
                    <div class="input-group">
                        <input type="text" name="search" id="navbar-search" class="form-control" placeholder="Axtar" value="{{ old('search')}}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{route('basket')}}"><i class="fa fa-shopping-cart"></i> Səbət <span class="badge badge-theme">{{Cart::count()}}</span></a></li>
                    @guest
                        <li><a href="{{route('user.login')}}">Daxil ol</a></li>
                        <li><a href="{{route('user.signup')}}">Qeydiyyat</a></li>
                    @endguest
                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{Auth::user()->name}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('orders')}}">Sifarişlərim</a></li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout_form').submit()">Çıxış</a>
                                    <form id="logout_form" action="{{route('user.logout')}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                
                </ul>
            </div>
        </div>
    </nav>