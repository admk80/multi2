@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1 >Edit Category</h1>
        </div>
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-6">
            @foreach ($category as $category)
            <form action = "{{ url('product/category/') }}/{{$category->id}}" method="post">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <input type="text" class="form-control " value="{{$category->cname}}" name="category" placeholder="Category Name" required>
                </div>

                <input type="submit" class="button btn " value="Update Category">
            </form>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')


@endsection