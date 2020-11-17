@extends('layouts.admin')

@section('main-content')

{!! Form::model($product, ['method' => 'PATCH','route' => ['product.update', $product->id], 'enctype' => 'multipart/form-data']) !!}
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
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form">
                    <label for="name">Name</label>
                    <input type="name" name="name" class="form-control" id="product_name" value="{{ $product->name }}" placeholder="Enter Product Name">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="category">Product Category</label>
                    <select class="form-control" name="category">
                        <option value="{{ $product->category }}">Please Select </option>
                        <?php foreach($productCategory as $pc) { ?>
                            <option value="{{ $pc->id }}" {{ $pc->id == $product->category ? "selected" : ""}}> {{ $pc->name }} </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile"> Choose File...</label>
                        <img src="{{ URL('/storage/images/ProductImages/'.$product->image) }}" width="70px" height="70px" alt="image">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="available_quantities">AvailableQuantities</label>
                    <input type="text" name="available_quantities" value="{{ $product->available_quantities }}" class="form-control" id="exampleInputAvailableQuantities" aria-describedby="AvailableQuantitiesHelp" placeholder="Enter Available Quantities">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" id="exampleInputPrice" aria-describedby="PriceHelp" placeholder="Enter Price">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="status">Product Status</label>
                    <select class="form-control" name="status" id="exampleFormCategory">
                        <option value="1" {{ $product->status == 1 ? "selected" : ""}}>Active</option>
                        <option value="0" {{ $product->status == 0 ? "selected" : ""}}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <textarea class="form-control" name="description" id="Textarea1" rows="3">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <div class="col-auto my-1 text-right" >
                        <a href="{{ route('product.index')}}"><button type="submit" class="btn btn-danger">Cancel</button></a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@endsection