@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1 >Add Category</h1>
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
          <form action = "{{ route('add-category') }}" method = "post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
              <div class="form-group">
        <input type="text" class="form-control " name="category" placeholder="Category Name" required>
              </div>

              <input type="submit" class="button btn " value="Add Category">
          </form>
      </div>
    </div>
@endsection

@section('scripts')


@endsection