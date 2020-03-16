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
        <div class="col-md-12 ">
            <h2 class="center"><strong>Shopping Cart</strong></h2>
            <table class="table" width="100%">
                <th class="center">#</th>
                 <th class="center" width="15%"></th>
                <th class="center">Product Name</th>
                <th class="center">Store Name</th>
                 <th class="center" width="5%">Quantity</th>
                <th class="center">Unit Price</th>
                  <th class="center">Total Price</th>
                <th class="center">Active</th>
                @if(isset($myCart) && !empty($myCart))
                @php $count=0; @endphp
                @foreach($myCart as $key =>$cart)
                <tr>
                    <td>{{++$count}}</td>
                    <td>
                        @if(isset($cart['product_image']))
                         <img src="../../public/images/{{$cart['product_image']}}" width="150">
                         @endif
                         </td>
                    <td>
                         @if(isset($cart['product_name']))
                           {{$cart['product_name']}}
                         @endif
                        </td>
                    <td>
                         @if(isset($cart['store_name']))
                           {{$cart['store_name']}}
                         @endif
                        </td>
                    <td>
                         @if(isset($cart['quantity']))
                           <input type="number" min="1" value="{{$cart['quantity']}}" name="quantity" id="q_{{$key}}">
                         @endif
                        </td>
                    <td>${{$cart['price']}}</td>
                        <td>
                         @if(isset($cart['total_price']))
                           ${{$cart['total_price']}}
                         @endif
                        </td>
                    <td><a href='javascript://' onclick="removeFromCart('{{$key}}')">Remove</a> | <a href='javascript://' onclick="updateCart('{{$key}}')">Update</a></td>
                </tr>
                @endforeach
                <tfoot>
                <tr>
                    <td><strong>Total Price</strong></td>
                    <td colspan="7">${{$total['total_price']}}</td>
                </tr>
                </tfoot>
                @else
                <tr>
                    <td colspan="3"> Please add some products</td>
                </tr>
                @endif
            </table>
            <br>
        </div>
    </div>
</div>
<script>
    function removeFromCart(key) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{url("remove_from_cart")}}',
            data: {"_token": "{{ csrf_token() }}", 'key': key},
            success: function (data) {
                console.log(data)
                if (data.status == 'success') {
                    alert('Product removed from cart.');
                    location.reload();
                } else {
                    alert('Product not removed from cart.');
                }

            }
        });
    }
      function updateCart(key) {
          var quantity=$('#q_'+key).val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{url("update_cart")}}',
            data: {"_token": "{{ csrf_token() }}", 'key': key,'quantity':quantity},
            success: function (data) {
                console.log(data)
                if (data.status == 'success') {
                    alert('Cart Updated');
                    location.reload();
                } else {
                    alert('Cart not Updated');
                }

            }
        });
    }
</script>
@endsection