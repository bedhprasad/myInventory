@extends('layouts.admin')

@section('main-content')

{{-- {{ Form::open(array('route' => 'product-category.store', 'method' => 'post')) }} --}}
<form method="POST" action="{{ route('product-category.store') }}">
    @csrf
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Product Category</h6>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{ route('product-category.index')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form">
                    <label for="exampleInputName">Category Name</label>
                    <input type="text" name="name" class="form-control" id="product_name" placeholder="Enter Product Category">
                    <p style="color:red">@error ('name') {{ "Category name is required" }} @enderror</p>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <div class="col-auto my-1 text-right">
                <a href="{{ route('product-category.index')}}"><button type="submit" class="btn btn-danger">Cancel</button></a>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </div>  
</div>

</form>
{{-- {{ Form::close() }} --}}

@endsection