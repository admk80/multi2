@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <h1 >All Categories</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <th>Product Name</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created</th>
            <th>Images</th>
            <th>Action</th>
            </thead>
            <tbody>

            @foreach ($products as $product)
            <tr>
                <?php
                    $images=$product->gallery;
                    $image=explode(',',$images);

                ?>
                <td> {{ $product->name }} </td>
                <td> {{ $product->title }} </td>
                <td> {{ $product->description }} </td>
                <td> {{ $product->created_at }} </td>
                  <td>  <?php for ($i=0;$i<count($image);$i++) { ?>
                        <img src="../../../public/images/<?=$image[$i];?>" width="150"/>
                    <?php }; ?>
                  </td>
                <td><a href="{{url('admin/product/remove')}}/{{$product->id}}"> Delete</a>&nbsp;<a href ="{{url('admin/product/edit')}}/{{ $product->id }}">Edit</a></td>
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