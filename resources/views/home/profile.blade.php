@extends('layouts.app')

@section('content')

<div class="container">
  @if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
  @endif

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
  <div class="row">
    <div class="col-md-6 ">
      <h2 class="center">Update Your Profile</h2>
      <form action = "{{ route('store.update') }}" method = "post"  enctype="multipart/form-data">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "id" value = "{{$results->id}}">
        <div class="form-group">
          <input type="text" class="form-control " name="name" placeholder="Store Name" value="{{$results->store_name}}">
        </div>

        <div class="form-group">
          <input type="text" class="form-control " name="address" placeholder="Store Address" value="{{$results->address}}">
        </div>

        <div class="form-group">
          <input type="email" class="form-control " name="email" placeholder="Email" required value="{{$results->email}}" readonly>
        </div>

        <div class="input-group control-group increment" >
          <label>Upload logo</label>
          <input type="file" name="filename" class="form-control">

        </div><br>
        <p style=""><img width="100" height="50" src="{{asset('images')}}/{{$results->logo}}"></p>
        <br>
        <input type="submit" class="button btn btn-primary" value="Submit">
      </form>
      <br>
    </div>
  </div>
</div>

@endsection