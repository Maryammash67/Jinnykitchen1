<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


	<!-- My CSS -->
	<link rel="stylesheet" href="assets/css/admin.css">
   


  

	<title>Jinny'sKitchen</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar" style="padding-left: 1px;">
	<a href="{{url('/admin')}}" class="brand">
	<i class='bx bx-restaurant' style="color:black;"></i>
			<span class="text" style="color:black;">Jinny Kitchen</span>
		</a>
		<ul class="side-menu top" style="padding-left: 1px;">
			<li class="active">
				<a href="{{url('/admin')}}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{url('/foodmenu')}}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Food-Menu</span>
				</a>
			</li>
			<li >
				<a href="{{url('/chefview')}}">
					<i class='bx bx-user' ></i>
					<span class="text">Chefs</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu "style="padding-left: 1px;">
			<li>
				<a href="{{route('user.settings')}}">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
            <li class="nav-item">
        <a href="#" class="nav-link logout" onclick="confirmLogout()">
            <i class='bx bxs-log-out-circle'></i>
            <span class="text">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
		</ul>
	</section>
	<!-- SIDEBAR -->



<!-- CONTENT -->
<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="" class="nav-link">Dashboard</a>
			<form action="">
				
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="" class="notification">
				<i class='bx bxs-message' ></i>
				<span class="num">3</span>
			</a>
			<a href="" class="profile">
			<img src="https://static.vecteezy.com/system/resources/previews/007/296/443/original/user-icon-person-icon-client-symbol-profile-icon-vector.jpg" alt="user-im" >
            {{ Auth::user()->name }}
			</a>
		</nav>
		<!-- end of NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-user' ></i>
					<span class="text">
						<h3>3</h3>
						<p>Users</p>
					</span>
				</li>
				<li>
					<i class='bx bx-restaurant' ></i>
					<span class="text">
						<h3>16</h3>
						<p>Food</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>6</h3>
						<p>Sales</p>
					</span>
				</li>
             
              
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						
						<i class='bx bx-search' >
							
					
                    <input type="text" name="search" id="search" placeholder=" Search User" class="form-control" onfocus="this.value=''">
              
                <div id="search_list"></div>
						</i>
						
					</div>
					<table>
						<thead>
							<tr>
								 
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
									<th>action</th>
							</tr>
						</thead>
						<tbody>
                        @foreach ($user as $user)
							<tr>
								<td>
									<p>{{ $user->name }}</p>
								</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
								<td>
            <i class="bx bx-filter"
               data-toggle="modal"
               data-target="#userModal"
               data-name="{{ $user->name }}"
               data-email="{{ $user->email }}"
               data-phone="{{ $user->phone }}"
               data-address="{{ $user->address }}"></i>
        </td>

							</tr>
						
                            @endforeach

						</tbody>
					</table>
				</div>
				
				
			</div>
		</main>

		<!-- MAIN -->
	
<!-- Bootstrap Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <!-- User image -->
                            <img src="{{ asset('assets/images/userImage.jpg') }}" alt="user image" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <!-- User details -->
                            <div id="user-details">
                                <!-- User details will be displayed here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
	</section>
	<!-- CONTENT -->


	
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/js/admin.js"></script>   
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search').on('keyup',function(){
            var query= $(this).val(); 
            $.ajax({
                url:"search",
                type:"GET",
                data:{'search':query},
                success:function(data){ 
                    $('#search_list').html(data);
                }
            });
             //end of ajax call
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#userModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            
            var name = button.data('name');
            var email = button.data('email');
            var phone = button.data('phone');
            var address = button.data('address');
            
            modal.find('.modal-title').text('User Details');
            modal.find('#user-details').html(`
                <p>Name: ${name}</p>
                <p>Email: ${email}</p>
                <p>Phone: ${phone}</p>
                <p>Address: ${address}</p>
            `);
        });
    });
</script>
</body>
</html>