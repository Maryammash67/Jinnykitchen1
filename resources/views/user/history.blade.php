<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
				<img src="assets/images/logojpg.png" height="50" width="120" alt="Logo" class="tm-site-logo" />  </a>
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
            <div style="display:flex;  justify-content: space-between;" >
        <div style="height: 850px; width: 720px; position: relative;height: fit-content;background: #ffffff; border-radius: 20px; padding: 2em; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); left: 15px;
        top: 20px; " >
  <canvas id="myChart"></canvas>
        </div>


        <div style="height: auto; width: 760px; position: relative;height: fit-content;background: #ffffff; border-radius: 20px; padding: 2em; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        top: 20px;">

            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Food</th>
                <th scope="col">Branch</th>
                <th scope="col">Quntity</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Total Price</th>
                <th></th>

                </tr>
            </thead>
            <tbody>
            @foreach($purchaseHistories as $history)
                <tr>
                    <td>{{ $history->food_name }}</td>
                    <td>{{ $history->branch_name }}</td>
                    <td>{{ $history->quantity }}</td>
                    <td>{{ $history->created_at}}</td>
                    <td>{{ $history->total_price}}</td>
                    <!-- You can calculate and display the total price here if needed -->
                    <td>
    <form
        action="{{ route('user.delete_purchase', ['purchaseId' => $history->id]) }}"
        method="POST"
    >
        @csrf
        @method('DELETE')
        <button
            type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Are you sure you want to delete this purchase?')"
        >
            Delete
        </button>
    </form>
</td>
                </tr>
                @endforeach         
                
            
            
            
            
            </tbody>
            </table>
 
        </div>
        </main>
    </div>
    </div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar', // Use a bar chart
    data: {
      labels: @json($labels), // Product names as labels on the x-axis
      datasets: @json($datasets) // Two bars for each branch
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Quantity' // Y-axis label
          }
        },
        x: {
          title: {
            display: true,
            text: 'Product Name' // X-axis label
          }
        }
      }
    }
  });
</script>

</body>
</html>