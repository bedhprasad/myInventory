@extends('layouts.admin')

@section('main-content')
{!! Form::model($productCategory, ['method' => 'PATCH','route' => ['product-category.update', $productCategory->id]]) !!}
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
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-4">
                        <div class="form">
                        <label for="exampleInputName">Category Name</label>
                        <input type="text" name="name" class="form-control" id="product_name" placeholder="Enter Product Category" value="{{ $productCategory->name }}">
                        <p style="color:red">@error('name') {{ "Category name is required" }} @enderror</p>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{ $productCategory->status == 1 ? "selected" : ""}}>Active</option>
                                <option value="0" {{ $productCategory->status == 0 ? "selected" : ""}}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="col-12">
                    <div class="form-group">
                        <div class="col-auto my-1 text-right" >    
                            <button type="submit" class="btn btn-danger">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </div> 
            </div> 
    </div>
{!! Form::close() !!}
@endsection