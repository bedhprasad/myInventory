@extends('layouts.admin')

@section('main-content')

{{ Form::open(array('route' => 'product.store', 'method' => 'post' , 'enctype' => 'multipart/form-data' )) }}
{{-- <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"> --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Product</h6>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{ route('product.index')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form">
                        <label for="name">Name</label>
                        <input type="name" name="name" class="form-control" id="product_name" placeholder="Enter Product Name">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="category">Product Category</label>
                        <select class="form-control" name="category">
                            <option value="">Please Select </option>
                            <?php foreach($productCategory as $pc) { ?>
                                <option value="{{ $pc->id }}"> {{ $pc->name }} </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="available_quantities">AvailableQuantities</label>
                        <input type="text" name="available_quantities" class="form-control" id="" placeholder="Enter Available Quantities">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" id="" aria-describedby="PriceHelp" placeholder="Enter Price">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="status">Product Status</label>
                        <select class="form-control" name="status" id="">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea class="form-control" name="description" id="Textarea1" rows="3"></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <div class="col-auto my-1 text-right" >
                            <a href="{{ route('product.index')}}"><button type="submit" class="btn btn-danger">Cancel</button></a>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
    </div>
{{-- </form> --}}
{{ Form::close() }}
@endsection