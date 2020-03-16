@extends('admin.layouts.default')


@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1>Edit Product</h1>
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
        @foreach ($product as $product)
            <form action="{{url('admin/product/edit1/')}}/{{$product->id}}" method="post" enctype="multipart/form-data"
                  style="width: 100%">
                <div class="col-md-6 offset-3">

                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control " name="name" placeholder="Product Name" required
                               value="{{$product->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control " name="title" placeholder="Product title" required
                               value="{{$product->title}}">
                    </div>

                    <div class="form-group">
                        <select class="form-control " name="category" placeholder="" required>
                            @foreach ($categories as $category)
                                @if($category->id == $product->category)
                                    <option value="{{$product->id}}" selected>{{$product->cname}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->cname}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {{--          ## Code By Abbas, cloning Categories for brands ##--}}
                    <div class="form-group">
                        <select class="form-control " name="brand_id" placeholder="" required>
                            @foreach ($brands as $brand)
                                @if($brand->id == $product->brand_id)
                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" required class="form-control" name="price" placeholder="Price"
                               value="{{$product->price}}">
                    </div>

                    <div class="form-group">
                        <textarea name="content" id="editor">{{$product->description}}</textarea>
                    </div>


                    <div class="input-group control-group increment">
                        <label>Upload Images</label>
                        <input type="file" name="filename[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add
                            </button>
                        </div>
                    </div>
                    <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>

                    <br>
                    <input type="submit" class="button btn " value="Update Product">
            </form>
        @endforeach
    </div>
    </div>
@endsection

@section('scripts')


@endsection