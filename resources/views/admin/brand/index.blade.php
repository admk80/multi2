@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1 >All Brands</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <th>Name</th>
            <th>Action</th>
            </thead>
            <tbody>

            @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->name }} </td>
                <td><a href="{{url('product/rem-brand')}}/{{$brand->id}}"> Delete</a>&nbsp;<a href ="{{url('product/brand/')}}/{{ $brand->id }}">Edit</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function() {
            $('#dtBasicExample').dataTable();

            $("[data-toggle=tooltip]").tooltip();

        } );

    </script>

@endsection