@extends('layouts.settingnav')

@section('content')
<p><b>SETTINGS</b></p>
<div class="settings-container">
    <div class="profile">
        <div class="basics">
            <img src="{{ asset('assets/images/userImage.jpg') }}" alt="user image">

            <div class="basic-d">
             
                
                <p><b>Full Name:</b>{{ $user->name }}</p>
                <p><b>Email address:</b> {{ $user->email }}</p>
                <p><b>Mobile number:</b> {{ $user->phone }}</p>
                <p><b>Address:</b> {{ $user->address }}</p>
             
            </div>

            

        </div>
    
    </div>
    <div class="changeP">
        <p><b>Change password</b></p>
        <form method="POST" action="{{ route('change-password', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
        @csrf    
        <div class="modal-body">
            <!--form start -->
            <div class="mb-3">
            <label for="oldpw" class="form-label">Old Password</label>
            <input id="oldPassword" type="password" class="form-control" name = "oldpw" placeholder="Enter your old password">
            <p id="confirmOldPassword" style="color: red; display: none;">Incorrect password</p>
            </div>
            
            <div class="mb-3">
            <label for="newpw" class="form-label">New Password</label>
            <input type="password" class="form-control" id="psw" name="newpw" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Enter a password that meets the criteria">
            </div>
            <div id="criteria">
            New password must contain the following:
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="specialChar" class="invalid">A <b>special character</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <div class="mb-3">
                <label for="cpw" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" name="cpw" id="confirmPassword" placeholder="Re-enter new password">
                <p id="confirmErrorMessage" style="color: red; display: none;">Passwords do not match</p>
            </div>

            
            <!-- end of form -->

        </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
<br>
<div class="changeP " style="margin-left: 300px;
  margin-right: 300px;padding-bottom: 60px;">
        <p><b>Update Personal Deatails</b></p>
        <form action="{{ route('updatep') }}" method="POST">
    @csrf
    @method('PUT')   
        <div class="modal-body">
            <!--form start -->
            <div class="mb-3">
            <label for="oldpw" class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="Enter your first name" name="name" value="{{ $user->name }}" >
            </div>
            
            <div class="mb-3">
            <label for="newpw" class="form-label">Email</label>
            <input type="text"class="form-control" placeholder="Enter your email" name="email" value="{{ $user->email }}" >
            </div>
            
            <div class="mb-3">
            <label for="newpw" class="form-label">Contact No</label>
            <input type="text" class="form-control" placeholder="Enter your email" name="phone" value="{{ $user->phone }}" >
            </div>

            <div class="mb-3">
            <label for="newpw" class="form-label">Address</label>
            <input type="text" class="form-control" placeholder="Enter your email" name="address" value="{{ $user->address }}" >
            </div>
            
            <!-- end of form -->

        </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <form action="{{ route('delete.profile') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"style="margin-right: 20px;background-color:red;">Delete Profile</button>
</form>
    </div>
</div>

@endsection