@extends('layouts.admin')

@section('main-content')

{{ Form::open(array('route' => 'user.store', 'method' => 'post' ,'id' => 'upload_image_form', 'enctype' => 'multipart/form-data' )) }}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="col-md-6 text-right">
            <a class="btn btn-sm btn-primary" href="{{ route('user.index')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form">
                    <label for="first_name">Name</label>
                    <input type="text" name="name" class="form-control" id="" placeholder="Enter Name" value="{{ old('name') }}">
                    <p class="red">@error ('name') {{ "Name is required" }} @enderror</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="" placeholder="Enter Email" value="{{ old('email') }}">
                    <p class="red">@error ('email') {{ "Email is required" }} @enderror</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea type="textarea" name="address" class="form-control" id="" placeholder="Enter Address" >{{ old('address') }}</textarea>
                    <p class="red">@error ('address') {{ "Address is required" }} @enderror</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" id="" placeholder="Enter City" value="{{ old('city') }}">
                    <p class="red">@error ('city') {{ "City is required" }} @enderror</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" name="mobile" class="form-control w-100" placeholder="Enter number" id="phoned_no" value="{{ old('mobile') }}">
                    <p class="red">@error ('mobile') {{ "Mobile is required" }} @enderror</p>
                    <span class="error_message3"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form">
                    <label for="state">State</label>
                    <input type="text" name="state" class="form-control" id="" placeholder="Enter State" value="{{ old('state') }}">
                    <p class="red">@error ('state') {{ "State is required" }} @enderror</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" id="" placeholder="Enter Country" value="{{ old('country') }}">
                    <p class="red">@error ('country') {{ "Country is required" }} @enderror</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" name="pincode" class="form-control" id="" placeholder="Enter Pincode" value="{{ old('pincode') }}">
                    <p class="red">@error ('pincode') {{ "Pincode is required" }} @enderror</p>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="image">User Image</label>
                        <div class="custom-file">
                            <input type="file" name="image" id="profile-img" class="custom-file-input" value="{{ old('image') }}">
                            <label class="custom-file-label" for="customFile" id="image">{{ old('image') }}</label>
                            <p class="red">@error ('image') {{ "Image is required" }} @enderror</p>
                            <img src="" id="profile-img-tag" width="100px"/>
                    

                        </div>
                    </div>
                </div>
            </div>
        <div class="col-12">
            <div class="form-group">
                <div class="col-auto my-1 text-right">
                    <a href="{{ route('user.index')}}"><button type="submit" class="btn btn-danger">Cancel</button></a>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </div>               
    </div>
{{ Form::close() }}

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/css/intlTelInput.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/intlTelInput.min.js"></script>
<style>
    .error {
        font-size: 1rem !important;
    }
    .iti--allow-dropdown input, .iti--allow-dropdown input[type=tel], .iti--allow-dropdown input[type=text], .iti--separate-dial-code input, .iti--separate-dial-code input[type=tel], .iti--separate-dial-code input[type=text] {
        padding-right: 68px !important;
    }
    .red{
        color: red;
    }
</style>

 {{-- For International phone number --}}
<script type="text/javascript">
    // $(document).ready(function () {
        var phoned_no = document.querySelector("#phoned_no");
        var error_message3 = document.querySelector(".error_message3");
        var update_button=document.getElementById('update-button');
        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
        // initialise plugin
        var iti_Popup = window.intlTelInput(phoned_no, {
            autoHideDialCode: true,
            autoPlaceholder: true,
            separateDialCode: true,
            hiddenInput: "phone",
            preferredCountries: ['in','gb', 'us','ae'],
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/utils.js"
        });

        var reset = function() {
            phoned_no.classList.remove("error");
            error_message3.innerHTML = "";
            error_message3.classList.add("hide");
        };
        // on blur: validate
        phoned_no.addEventListener('blur', function() {
            reset();
            if (phoned_no.value.trim()) {
                if (iti_Popup.isValidNumber()) {
                    update_button.disabled=false;
                } else {
                    phoned_no.classList.add("error");
                    var errorCode = iti_Popup.getValidationError();
                    error_message3.innerHTML = errorMap[errorCode];
                    error_message3.classList.remove("hide");
                    update_button.disabled=true;
                }
            }
        });
        // on keyup / change flag: reset
        phoned_no.addEventListener('change', reset);
        phoned_no.addEventListener('keyup', reset);



</script>
<script>
    $(document).ready(function() {
        $("#profile-img").change(function(){
            //console.log(this);
            readURL(this);
        });
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log(reader);
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
 
</script>
@endsection