<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>



	<!-- My CSS -->
	<link rel="stylesheet" href="assets/css/admin.css">
   
	

  

	<title>Jinny's Kitchen</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
	<a href="{{url('/admin')}}" class="brand">
	<i class='bx bx-restaurant' style="color:black;"></i>
			<span class="text" style="color:black;">Jinny Kitchen</span>
		</a>
		<ul class="side-menu top" style="padding-left: 1px;">
			<li >
				<a href="{{url('/admin')}}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="{{url('/foodmenu')}}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Food-Menu</span>
				</a>
			</li>
			<li class="active">
				<a href="{{url('/chefview')}}">
					<i class='bx bx-user' ></i>
					<span class="text">Chefs</span>
				</a>
			</li>
		
		</ul>
		<ul class="side-menu"  style="padding-left: 1px;">
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
				<!-- MAIN -->
				<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('/admin')}}">Home</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{url('/chefview')}}">Chef Details</a>
						</li>
					</ul>
				</div>
				
			</div>
		
			

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Chefs</h3>

						   
			
						<!-- Button trigger modal pop up -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Add Chef
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Deatils</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<!--  form start -->
      <div class="modal-body">
      
      <form action="{{ url('/uploadchef') }}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="mb-3">
        <label for="foodtitle" class="form-label">Full Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" required>
    </div>
   
    <div class="mb-3">
        <label for="description" class="form-label">Speciality:</label>
        <textarea class="form-control" id="speciality" placeholder="Speciality" name="speciality" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
  

    <button type="submit" class="btn btn-primary">Save</button>
</form>
      </div>
	  <!-- end form start -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
					</div>
                     <div class="table-container">
					<table>
						<thead>
							<tr>
							<th>Name</th>
							<th>Speciality</th>
							<th>Image</th>
							<th></th>
							<th></th>
							</tr>
						</thead>
                        <tbody id="chefTableBody">
                       
                       @foreach ($chef as $chef)
                           <tr id="chefRow{{ $chef->id }}" >
                           
                           
                       <td>{{ $chef->name }}</td>
                       <td>{{ $chef->speciality }}</td>
                     
                       <td>  <img src="{{ asset('chef/' . $chef->image) }}" alt="{{ $chef->name }}" width="150" height="150"></td>
                       <td>
    <a href="" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal({{ $chef->id }})">
        <i class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;"></i>
    </a>
</td>
						<td> <a href="{{ url('/deleteChef', $chef->id) }}"><i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" onclick="confirmDelete1(event)"></i></a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>

          		

			</div>
		</main>
	</section>
	<!-- CONTENT -->


        <!-- The Bootstrap modal for editing -->
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-label">Edit Food Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('updatechef') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="chef_id" id="chef_id">
                        <div class="form-group">
                            <label for="name">Food Title:</label>
                            <input type="text" class="form-control" name="name" id="edit_name">
                        </div>
                       
                        <div class="form-group">
                            <label for="speciality">Description:</label>
                            <textarea class="form-control" name="speciality" id="edit_speciality"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="current_image">Current Image:</label>
                            <img src="" alt="Current Image" id="edit_current_image" width="150" height="150">
                        </div>
                        <div class="form-group">
                            <label for="new_image">New Image (leave empty to keep current image):</label>
                            <input type="file" class="form-control" name="new_image" id="edit_new_image">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




	<script>
        function openEditModal(chefId) {
            var chefRow = document.getElementById('chefRow' + chefId);
            var chefName = chefRow.querySelector('td:nth-child(1)').textContent; 
            var chefSpeciality = chefRow.querySelector('td:nth-child(2)').textContent;
            var chefImageSrc = chefRow.querySelector('td:nth-child(3) img').src;

            document.getElementById('chef_id').value = chefId;
            document.getElementById('edit_name').value = chefName;
            document.getElementById('edit_speciality').value = chefSpeciality;
           document.getElementById('edit_current_image').src = chefImageSrc;
		
        

        var editModal = document.getElementById('editModal');
    editModal.show();
        }
    </script>
	





	
	

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/js/admin.js"></script>   
  

</body>
</html>