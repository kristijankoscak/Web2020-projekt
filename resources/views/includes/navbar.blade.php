<nav class="navbar navbar-expand-lg navbar-dark colorGreenDark">
    <div class="container justify-content-center">
        <a class="navbar-brand navbarTextColor" href="{{ url('/') }}">
            {{ config('app.name', 'mojOPG!') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                {!!Form::open(['action'=>'PagesController@search','method'=>'GET','class'=>'form-inline']) !!}
                    <input id="searchBar" name="searchBar" class="form-control mr-sm-2 colorGreenLight-op-05" type="search" placeholder="Search">
                    <button class="btn btn-outline-secondary rounded-circle" type="submit"><i class="fas fa-search"></i></button>
                {!! Form::close() !!}

            </ul>
            <ul class="nav navbar-nav align-middle">
                <li class="nav-item">
                    <a class="nav-link navbarTextColor" href="/Kopg/public/">Početna <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link navbarTextColor" href="/Kopg/public/products">Oglasna ploča</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbarTextColor" href="/Kopg/public/instructions">Upute</a>
                </li>                
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link navbarTextColor" href="{{ route('login') }}">{{ __('Prijava') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link navbarTextColor" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                        </li>
                    @endif
                @else
                    <div class="container-flex mt-1" style="height:32px; width:32px;">
                        @if(Auth::user()->user_type === "admin")
                            <img class='rounded-circle border border-danger' src='/Kopg/public/storage/user_images/{{Auth::user()->image_link}}' alt="Product image" style="width:100%; height:100%;"> 
                        @else
                        <img class='rounded-circle border border-white' src='/Kopg/public/storage/user_images/{{Auth::user()->image_link}}' alt="Product image" style="width:100%; height:100%;"> 
                        @endif
                    </div>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle navbarTextColor" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->user_type === "admin")
                                <a class="dropdown-item" href="/Kopg/public/products-reported">Prijavljeni proizvodi</a>
                                <a class="dropdown-item" href="/Kopg/public/comments-reported">Prijavljeni komentari</a>
                            @endif
                            @if(Auth::user()->user_type === "seller")
                                <a class="dropdown-item" href="/Kopg/public/user/{{Auth::user()->id}}">Moji profil</a>
                                <a class="dropdown-item" href="/Kopg/public/dashboard">Moji oglasi</a>
                                <a class="dropdown-item" href="/Kopg/public/products/create">Predaj oglas</a>
                            @endif
                            <a class="dropdown-item" href="/Kopg/public/user/{{ Auth::user()->id}}/edit">Ažuriraj podatke</a>
                            <a class="dropdown-item" href="/Kopg/public/user/{{ Auth::user()->id}}/password-change">Promjeni lozinku</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Odjava') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>