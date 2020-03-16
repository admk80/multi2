@extends('admin.layouts.default')


@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1 >Add Product</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
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
        <form action = "{{url('admin/products/add')}}" method = "post" enctype="multipart/form-data" style="width: 100%">
      <div class="col-md-6 offset-3">

          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
              <div class="form-group">
        <input type="text" class="form-control " name="name" placeholder="Product Name" required>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control " name="title" placeholder="Product title" required>
              </div>
          <div class="form-group">
              <select class="form-control " name="category" placeholder="" required>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->cname}}</option>
                      @endforeach
              </select>
          </div>
{{--          ## Code By Abbas, cloning Categories for brands ##--}}
          <div class="form-group">
              <select class="form-control " name="brand_id" placeholder="" required>
                  @foreach ($brands as $brand)
                      <option value="{{$brand->id}}">{{$brand->name}}</option>
                      @endforeach
              </select>
          </div>
          <div class="form-group">
              <input type="number" required class="form-control" name="price" placeholder="Price">
          </div>


          <div class="form-group">
              <textarea name="content" id="editor"></textarea>
              </div>





          <div class="input-group control-group increment" >
              <label>Upload Images</label>
              <input type="file" name="filename[]" class="form-control">
              <div class="input-group-btn">
                  <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
              </div>
          </div>
          <div class="clone hide">
              <div class="control-group input-group" style="margin-top:10px">
                  <input type="file" name="filename[]" class="form-control">
                  <div class="input-group-btn">
                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                  </div>
              </div>
          </div>

<br>
              <input type="submit" class="button btn " value="Add Product">
        </form>
    </div>
    </div>
@endsection

@section('scripts')


@endsection