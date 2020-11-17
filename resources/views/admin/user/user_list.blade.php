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
            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
          </div>
          <div class="col-md-6 text-right">
            <a class="btn btn-sm btn-primary" href="{{ route('user.create')}}">Add New</a>
          </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Mobile</th>
              <th>Address</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($user as $u) : ?>
            <tr>
              <td><a href="{{ URL('/storage/images/UserImages/'.$u->image) }}" target="_blank"><img src="{{ URL('/storage/images/UserImages/'.$u->image) }}" width="50px" height="50px" alt="image"></a></td> 
              <td>{{ $u->name }}</td>
              <td>{{ $u->email}}</td>
              <td>{{ $u->mobile }}</td>
              <td>{{ $u->address.' '.$u->city.' '.$u->state.' '.$u->country.' '.$u->pincode }}</td>
              <td>{{ $u->created_at }}</td>
              <td class="text-center">
                <form method="POST" action="{{ route('user.destroy', $u->id) }}">
                    @csrf 
                    <a href="{{ URL::route('user.edit', $u->id) }}"><span class="fa fa-edit"></span></a>
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