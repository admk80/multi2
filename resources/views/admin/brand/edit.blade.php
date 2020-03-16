@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1 >Edit Brand</h1>
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
            @foreach ($brand as $brand)
            <form action = "{{ url('product/brand/') }}/{{$brand->id}}" method="post">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <input type="text" class="form-control " value="{{$brand->name}}" name="brand" placeholder="Brand Name" required>
                </div>

                <input type="submit" class="button btn " value="Update Brand">
            </form>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')


@endsection