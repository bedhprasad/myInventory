@extends('layout.admin')

@section('main-content')

{!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
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
                    <input type="text" name="name" class="form-control" id="" value="{{ $user->name }}" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="" value="{{ $user->email }}" placeholder="Enter Email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea type="textarea" name="address" class="form-control" id="" placeholder="Enter Address">{{ $user->address }}</textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" id="" value="{{ $user->city }}" placeholder="Enter City">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" name="mobile" class="form-control w-100" value="{{ $user->mobile }}" placeholder="Enter number" id="phoned_no">
                    <span class="error_message3"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form">
                    <label for="state">State</label>
                    <input type="text" name="state" class="form-control" id="" value="{{ $user->state }}" placeholder="Enter State">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" id="" value="{{ $user->country }}" placeholder="Enter Country">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" name="pincode" class="form-control" id="" value="{{ $user->pincode }}" placeholder="Enter Pincode">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="image">User Image</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile"> Choose File...</label>
                        <img src="{{ URL('/storage/images/UserImages/'.$user->image) }}" width="70px" height="70px" alt="image">
                        {{-- <span> {{ $user->image }}</span> --}}
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/css/intlTelInput.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/intlTelInput.min.js"></script>
<style>
    .error {
        font-size: 1rem !important;
    }
    .iti--allow-dropdown input, .iti--allow-dropdown input[type=tel], .iti--allow-dropdown input[type=text], .iti--separate-dial-code input, .iti--separate-dial-code input[type=tel], .iti--separate-dial-code input[type=text] {
        padding-right: 68px !important;
    }
</style>
<script type="text/javascript">
    //$(document).ready(function () {
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

    //});


</script>
@endsection