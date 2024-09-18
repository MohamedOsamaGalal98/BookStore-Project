<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

      <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <style>
.fa-cart-plus{
  background:#0652DD;
}

.addtocart{
  display:block;

  padding:0.25em 0.5em; /* Reduced padding */
  border-radius:100px; /* Adjusted border-radius */
  border:none;
  font-size:1em; /* Reduced font-size */
  position:relative;
  background:#0652DD;
  cursor:pointer;
  height:3em; /* Reduced height */
  width:10em; /* Reduced width */
  overflow:hidden;
  transition:transform 0.1s;
  z-index:1;
}
.addtocart:hover{
  transform:scale(1.1);
}
.pretext{
  color:#fff;
  background:#0652DD;
  position:absolute;
  top:0;
  left:0;
  height:100%;
  width:100%;
  display:flex;
  justify-content:center;
  align-items:center;
  font-family: 'Quicksand', sans-serif;
}
i{
  margin-right:10px;
}
.done{
  background:#be2edd;
  position:absolute;
  width:100%;
  top:0;
  left:0;
  transition:transform 0.3s ease;
  transform:translate(-110%) skew(-40deg);
}
.posttext{
  background:#be2edd;
}
.fa-check{
  background:#be2edd;
}

</style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/books/')}}">BookStore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">
      @foreach($departments as $department)
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/books?department='. $department->id)}}">{{$department->name}}<span class="sr-only">(current)</span></a>
      </li>
      @endforeach
    </ul>

   
                    <!-- Right Side Of Navbar -->

                 <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <!-- cart -->

                        <form class="form-inline my-2 my-lg-0" >
                        <a href="{{url('/cart')}}"><i class="fa-solid  fa-cart-plus fa-2xl fa-border-null fa-pull-left" ></i></a>
                        </form>

                        <!--search -->
                    <form class="form-inline my-2 my-lg-0" >
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q"> 
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                   
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                 
                </div>
        </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

     <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   



<script src="https://kit.fontawesome.com/69d4f6a159.js" crossorigin="anonymous"></script>
<script>
document.addEventListener('click', function(event) {
  if (event.target.closest('.addtocart')) {
    const button = event.target.closest('.addtocart');
    const done = button.querySelector('.done');
    let added = button.classList.contains('added');

    if (added) {
      done.style.transform = "translate(-110%) skew(-40deg)";
      button.classList.remove('added');
    } else {
      done.style.transform = "translate(0px)";
      button.classList.add('added');
    }
  }
});
</script>
</body>
</html>

