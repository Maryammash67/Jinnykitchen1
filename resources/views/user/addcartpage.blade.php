<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jinny Kitchen cart</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="assets/css/addcart.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
			
                <a class="navbar-brand" href="{{ url('/') }}">
				<img src="assets/images/logojpg.png" height="50" width="120" alt="Logo" class="tm-site-logo" />                 </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
            </div>
        </nav>

        <main class="py-4">
		<div class="wrapper">
		<h1 style="font-size:20px">Welcome {{ $user->name }} for your cart</h1>
		<div class="project">
			<div class="shop">

			<?php
			$totalprice=0;
			?>
			@foreach ($cartItems as $cartItem)
				<div class="box">
					<img src="{{ asset('food/' . $cartItem->food->image) }}" alt="{{ $cartItem->food->foodtitle }}">
					<div class="content">
						<h3>{{ $cartItem->food->foodtitle }} </h3>
						<p style=" margin-top: 0;margin-bottom: 0rem;">Size: {{ $cartItem->size }}</p>
						<p style=" margin-top: 0;margin-bottom: 0rem;">Branch: {{ $cartItem->branch_name }}</p>
						<p class="unit">Total Price: {{ number_format($cartItem->price * $cartItem->quantity, 1) }} Lkr</p>

						<p class="unit">Quantity: <input name="" value="{{ $cartItem->quantity }}"></p>
						<form action="{{ route('cart.remove', $cartItem) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></button>
        </form>					
	</div>
				</div>

				<?php
			
					$totalprice +=$cartItem->total_price;
				?>
				@endforeach
				

			</div>
			<div class="right-bar">
				<p><span>Quantity</span> <span></span></p>
				<hr>
				
				<p><span>Total</span> <span> Rs{{$totalprice}}.00</span></p>
				
				@if($sameBranch)
    <a href="{{url('stripe',$totalprice)}}"><i class="fa fa-shopping-cart"></i> Checkout</a>
@else
    <p style="font-size:12px; color:red;"> Checkout unavailable.Make sure you check out with same branch</p>
@endif

			</div>
		</div>
	</div>

        </main>
    </div>
    




	
</body>
</html>