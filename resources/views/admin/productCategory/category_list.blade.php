@extends('layouts.admin')

@section('main-content')
@if ($message = Session::get('success'))
  <div class="alert alert-success">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  </div>
@endif
<div class="card shadow mb-4">
  <div class="card-header py-3"> 
    <div class="row">
      <div class="col-md-6">
        <h6 class="m-0 font-weight-bold text-primary">Product Category List</h6>
      </div>
      <div class="col-md-6 text-right">
        <a class="btn btn-sm btn-primary" href="{{ route('product-category.create') }}">Add New</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Category Name</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
      {{-- to call db columns in views using model name --}}
        <tbody>
          <?php foreach ($productCategory as $pc) : ?>
            <tr>
              <td>{{ $pc->name }}</td>
              <td>{{ $pc->status == 1 ? 'Active' : 'Inactive' }}</td>
              <td>{{ $pc->created_at }}</td>
              <td class="text-center">
                <form method="POST" action="{{ route('product-category.destroy', $pc->id) }}">
                  @csrf 
                  <a href="{{ URL::route('product-category.edit', $pc->id) }}"><span class="fa fa-edit"></span></a>
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" class="btn btn-small show_confirm" data-toggle="tooltip" title='Delete'> <span class="fa fa-trash-alt"></span> </button>
                </form>                
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript">
      $('.show_confirm').click(function(e) {
          if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
          }
      });
  </script>

@endsection