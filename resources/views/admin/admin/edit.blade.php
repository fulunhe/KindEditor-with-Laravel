@extends('admin.app')

@section('content')
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Edit admin info</div>

        <div class="panel-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ URL('admin/admins/'.$admin->id) }}" enctype="multipart/form-data" method="POST">
           <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
       user name：     <input type="text" name="name" class="form-control" required="required" value="{{ $admin->name }}">
            <br>
      Email address： <input type="text" name="email" class="form-control" required="required" value="{{ $admin->email }}">
            <br>
                        Password：<input type="password" name="password" class="form-control" required="required">
            <br>
             Confirm your password：<input type="password" name="password_confirmation" class="form-control" required="required">
            <button class="btn btn-lg btn-info">Edit admin</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>  
@endsection
