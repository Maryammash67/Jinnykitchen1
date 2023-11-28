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
<style>
    .close-attribute {
    background-color: black;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 20px;
    cursor: pointer;
}

.close-attribute:hover {
    background-color: red; /* Change color on hover if desired */
}
.thin-input {
    height: 30px; /* Adjust the height as needed */
    padding: 5px 10px; /* Adjust the padding as needed */
    font-size: 14px; /* Adjust the font size as needed */
    border: 1px solid #ccc; /* Add a border if desired */
    border-radius: 5px; /* Add border-radius for rounded corners */
    outline: none; /* Remove the input field outline on focus */
    transition: border-color 0.2s; /* Add a transition for a smooth effect */
}

/* Add hover and focus styles if desired */
.thin-input:hover {
    border-color: #999; /* Change border color on hover */
}

.thin-input:focus {
    border-color: #007bff; /* Change border color on focus */
}


</style>
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
			<li class="active">
				<a href="{{url('/foodmenu')}}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Food-Menu</span>
				</a>
			</li>
			<li>
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
            <li class="nav-item"  style="padding-left: 1px;">
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
							<a class="active" href="{{url('/foodmenu')}}">Food-Menu</a>
						</li>
					</ul>
				</div>
				
			</div>
			<ul class="box-info">
				<li class="food-box " onclick="filterByCategory('food'); openAddFoodModal('food')">
					<i class='bx bx-dish' ></i>
					<span class="text">
					<h3 id="foodCount">{{ $foodCount }}</h3>
						<p>food</p>
					</span>
				</li>
				<li class="beverages-box" onclick="filterByCategory('Beverages'); openAddFoodModal('Beverages')">
					<i class='bx bxs-drink' ></i>
					<span class="text">
					<h3 id="beveragesCount">{{ $beverageCount }}</h3>
						<p>Beverages</p>
					</span>
				</li>
				<li  class="dessert-box"  onclick="filterByCategory('Dessert'); openAddFoodModal('Dessert')">
					<i class='bx bx-restaurant' ></i>
					<span class="text">
					<h3 id="dessertCount">{{ $dessertCount }}</h3>
						<p>Dessert</p>
					</span>
				</li>
              
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Food-Menu</h3>

			
						<!-- Button trigger modal pop up -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Add Food
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Food Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	<!--  form start -->
      <div class="modal-body">
      
	  <form action="{{ url('/uploadfood') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="foodtitle" class="form-label">Food Title:</label>
        <input type="text" class="form-control" id="foodtitle" placeholder="Food Title" name="foodtitle" required>
    </div>
 

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" placeholder="Description" name="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category:</label>
        <input type="text" class="form-control" id="category" placeholder="Category" name="category" required>
		
    </div>
   
    <div class="mb-3">
    <label for="branches" class="form-label">Select Branches:</label>
    <div>
        @foreach ($branches as $branch)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="branches[]" value="{{ $branch->id }}">
                <label class="form-check-label" for="branches">{{ $branch->name }}</label>
                <!-- Add input field for branch quantity -->
                <input type="text" name="branch_quantities[{{ $branch->id }}]" class="thin-input" placeholder="Quantity" >
            </div>
        @endforeach
    </div>
</div>
	  <!-- Attributes -->
	  <div class="mb-3">
    <label for="attributes" class="form-label">Attributes:</label>
    <div class="attribute-inputs">
        <div class="attribute-input">
            <input type="text" name="sizes[]" placeholder="Size" class="thin-input" required style="margin-bottom: 6px;">
            <input type="text" name="prices[]" placeholder="Price" class="thin-input" required style="margin-bottom: 6px;">
            <input type="text" name="quty[]" placeholder="Quantity" class="thin-input" required style="margin-bottom: 6px;">
			<button type="button" class="close close-attribute"  aria-label="Close">&times;</button>
           


        </div>
    </div>
    <button type="button" id="add-attribute" class="btn btn-secondary" style="margin-top: 12px;">Add Attribute</button>
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
                     <div class="table-container" style="max-height: 500px; overflow-y: scroll;">
                     <table class="table table-light table-hover">
    <thead>
        <tr>
            <th>Food Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Category</th>
            <th>Attribute Size</th>
            <th></th>
           
            <th>Branches</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="foodTableBody">
        @foreach ($food as $foodItem)
            <tr  id="foodRow{{ $foodItem->id }}" data-category="{{ $foodItem->category }}" data-attributes="{{ $foodItem->attributes }}">
                <td>{{ $foodItem->foodtitle }}</td>
                <td>{{ $foodItem->description }}</td>
                <td>
                    <img src="{{ asset('food/' . $foodItem->image) }}" alt="{{ $foodItem->foodtitle }}" width="150" height="150">
                </td>
                <td>{{ $foodItem->category }}</td>
                <td colspan="2">
                    @if ($foodItem->attributes->count() > 0)
                        @foreach ($foodItem->attributes as $attribute)
                        <div style="display: inline-block; margin-right: 0px;">
                <p><strong>Size:</strong> {{ $attribute->size }}</p>
                <p><strong>Price:</strong> {{ $attribute->price }}</p>
                <p><strong>Quantity:</strong> {{ $attribute->quty }}</p>
            </div>
                        @endforeach
                    @else
                        No attributes available
                    @endif
                </td>
                <td>
                <!-- Loop through branches and quantities for this food item -->
                @if ($foodItem->branches->count() > 0)
                    <ul>
                        @foreach ($foodItem->branches()->get() as $branch)
                            <li>{{ $branch->name }} (Quantity: {{ $branch->pivot->quantity ?? 'N/A' }})</li>
                        @endforeach
                    </ul>
                @else
                    No branches available
                @endif
            </td>
                <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal({{ $foodItem->id }})">
                        <i class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;"></i>
                    </a>
                </td>
                <td>
                    <a href="{{ url('/deleteFood', $foodItem->id) }}">
                        <i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" onclick="confirmDelete(event)"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

                   <!-- <table>
    <thead>
        <tr>
            <th>Branch</th>
            <th>Food Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Category</th>
            <th>Attribute Size</th>
            <th>Attribute Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="foodTableBody">
        @foreach ($branches as $branch)
            @if (isset($foodByBranch[$branch->name]))
                @foreach ($foodByBranch[$branch->name] as $foodItem)
                    <tr class="branch-header">
                        <td colspan="8">{{ $branch->name }}</td>
                       
                    </tr>
                    @foreach ($foodByBranch[$branch->name] as $food)
                        <tr id="foodRow{{ $food->id }}" data-category="{{ $food->category }}" data-attributes="{{ $food->attributes }}">
                            <td></td>
                            <td>{{ $food->foodtitle }}</td>
                            <td>{{ $food->description }}</td>
                            <td>
                                <img src="{{ asset('food/' . $food->image) }}" alt="{{ $food->foodtitle }}" width="150" height="150">
                            </td>
                            <td>{{ $food->category }}</td>
                            <td colspan="2">
                                @if ($food->attributes->count() > 0)
                                    @foreach ($food->attributes as $attribute)
                                        <p><strong>Size:</strong> {{ $attribute->size }}</p>
                                        <p><strong>Price:</strong> {{ $attribute->price }}</p>
                                        <p><strong>Quantity:</strong> {{ $attribute->quty }}</p>
                                        <hr>
                                    @endforeach
                                @else
                                    No attributes available
                                @endif
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal({{ $food->id }})">
                                    <i class="bx bx-pencil bounce-icon" style="color: #449e3d; font-size: 24px;"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('/deleteFood', $food->id) }}">
                                    <i class="bx bx-trash bounce-icon" style="color: #FF0000; font-size: 24px;" onclick="confirmDelete(event)"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td colspan="9">No food items available for {{ $branch->name }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>-->

				</div>

          		

			</div>
		</main>
	</section>
	<!-- CONTENT -->



    <!-- The Bootstrap modal for editing -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
        <div class=" modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-label">Edit Food Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('updatefood') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="food_id" id="food_id">
                        <div class="form-group">
                            <label for="foodtitle">Food Title:</label>
                            <input type="text" class="form-control" name="foodtitle" id="edit_foodtitle">
                        </div>
                       
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="edit_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="current_image">Current Image:</label>
                            <img src="" alt="Current Image" id="edit_current_image" style=" border-radius: 50%;" width="150" height="150">
                        </div>
                        <div class="form-group">
                            <label for="new_image">New Image (leave empty to keep current image):</label>
                            <input type="file" class="form-control" name="new_image" id="edit_new_image">
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
							<span id="edit_category_display"></span>
                            <input type="text" class="form-control" name="category" id="edit_category" hidden disabled >
                        </div>

                     
                      
						<div class="form-group">
                        <label for="edit_attributes">Attributes:</label>
                        <div id="edit_attributes" >
                            <!-- Attribute fields will be added here -->
                        </div>
                    </div>
                    
						<div id="edit_attributes"></div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




	<script>
  function openEditModal(foodId) {
    var foodRow = document.getElementById('foodRow' + foodId);
    var foodTitle = foodRow.querySelector('td:nth-child(1)').textContent;
    var foodDescription = foodRow.querySelector('td:nth-child(2)').textContent;
    var foodCategory = foodRow.querySelector('td:nth-child(4)').textContent;
    var foodImageSrc = foodRow.querySelector('td:nth-child(3) img').src;

    document.getElementById('food_id').value = foodId;
    document.getElementById('edit_foodtitle').value = foodTitle;
    document.getElementById('edit_description').value = foodDescription;
    document.getElementById('edit_current_image').src = foodImageSrc;
    document.getElementById('edit_category_display').textContent = foodCategory;

    
    var attributesData = foodRow.getAttribute('data-attributes');
    var attributesArray = JSON.parse(attributesData);

    var attributesContainer = document.getElementById('edit_attributes');
    attributesContainer.innerHTML = '';

	if (attributesArray) {
    for (var i = 0; i < attributesArray.length; i++) {
        var attributeDiv = document.createElement('div');
        attributeDiv.className = 'attribute-group';

        var sizeInput = document.createElement('input');
        sizeInput.type = 'text';
        sizeInput.className = 'form-control';
        sizeInput.name = 'edit_sizes[]' ;
        sizeInput.value = attributesArray[i].size;
        sizeInput.style.marginBottom = '6px';
        attributeDiv.appendChild(sizeInput);

        var priceInput = document.createElement('input');
        priceInput.type = 'text';
        priceInput.className = 'form-control';
        priceInput.name = 'edit_prices[]';
        priceInput.value = attributesArray[i].price;
        priceInput.style.marginBottom = '6px';
        attributeDiv.appendChild(priceInput);

        var qtyInput = document.createElement('input');
        qtyInput.type = 'text';
        qtyInput.className = 'form-control';
        qtyInput.name = 'edit_qtys[]';
        qtyInput.value = attributesArray[i].quty;
        qtyInput.style.marginBottom = '6px';
        attributeDiv.appendChild(qtyInput);

        attributesContainer.appendChild(attributeDiv);
    }
	}
    
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

    </script>



	<script>
		window.onload = function () {
	// By default, show "food" rows
	filterByCategory('food');
	openAddFoodModal('food');
	
};

function filterByCategory(category) {
	console.log('Filtering by category:', category);
	// Hide all rows
	let rows = document.querySelectorAll('[id^="foodRow"]');
	rows.forEach(row => {
		row.style.display = 'none';
	});

	// Show rows that match the selected category
	let filteredRows = document.querySelectorAll(`[id^="foodRow"][data-category="${category}"]`);
	filteredRows.forEach(row => {
		row.style.display = 'table-row';
	});
	
}
function openAddFoodModal(category) {
	// Set the value of the category input field in the modal
	const categoryInput = document.getElementById('category');
	categoryInput.value = category;
	selectedCategory = category;
}

	</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addAttributeButton = document.getElementById('add-attribute');
        const form = document.getElementById('food-form');
        const attributeInputs = document.querySelector('.attribute-inputs');

        addAttributeButton.addEventListener('click', function () {
            const attributeInput = document.createElement('div');
            attributeInput.className = 'attribute-input';
            attributeInput.innerHTML = `
                <input type="text" name="sizes[]" placeholder="Size" class="thin-input" style="margin-bottom: 6px;" required>
                <input type="text" name="prices[]" placeholder="Price" class="thin-input" style="margin-bottom: 6px;" required>
                <input type="text" name="quty[]" placeholder="Quantity" class="thin-input" style="margin-bottom: 6px;" required>
                <button type="button" class="close-attribute">&times;</button>
            `;

            attributeInputs.appendChild(attributeInput);
            
            const closeButtons = attributeInputs.querySelectorAll('.close-attribute');
            closeButtons.forEach(closeButton => {
                closeButton.addEventListener('click', function () {
                    attributeInputs.removeChild(attributeInput);
                });
            });
        });
    });
</script>






	
	

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/js/admin.js"></script>   
  

</body>
</html>