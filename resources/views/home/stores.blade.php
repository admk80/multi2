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

           <?php
           if(session('store')!=""){?>
<div class="col-md-12">
               <h1 class="center">Welcome <?=session('store')?></h1>
</div>
                   <div class="col-md-2">
                       <ul class="dash">
                           <li><a href="#"> My Prices</a></li>
                           <li><a href="#"> Orders</a></li>
                           <li><a href="{{route('store.profile')}}"> Edit My Details</a></li>
                           <li><a href="{{route('store.loggout')}}"> Logg out</a></li>

                       </ul>
                   </div>
                   <div class="col-md-10">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Product Store Info</th>
                          <!-- <th>Add To cart</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $allproducts)
                          
                          <tr>
                            <td>
                                <?php
                                $images=$allproducts->gallery;
                                $all=explode(',',$images);

                                ?>
                              <img width="100" height="50" src="{{asset('images')}}/<?=$all[0];?>">
                              <p>{{$allproducts->title}}</p>
                            </td>
                            <td>
                              <table class="table" width="100%">
                                  <th class="center"></th>
                                  <th class="center">Store Name</th>
                                  <th class="center">Price</th>
                                  <th class="center"></th>

                                  @foreach($allproducts->prices as $price)
                                    <tr>
                                        <td>

                                          <img src="{{asset('images')}}/{{$price->logo}}" width="75">
                                        </td>
                                        <td>{{$price->store_name}}</td>
                                        <td >$<span class="productPrice">{{$price->price}}</span></td>
                                        <td>        
                                          <button type="button" class="editButton btn btn-default btn-sm">
                                            <!-- <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                Add to Cart -->
                                                Edit
                                          </button>
                                          <input type="hidden" name="new_pid" class="new_pid" value="{{$allproducts->id}}">
                                          <input type="hidden" name="new_sid" class="new_sid" value="{{$store->id}}">
                                        </td> 
                                        <tr>
                                          
                                        </tr>
                                    </tr>
                                  @endforeach
                              </table>
                              <?php
                                if(session('store')!="" && count($allproducts->prices) < 1) { ?>
                                  <div class="col-md-6 offset-3">
                                      <!-- <h2 class="center">You are Logged in as {{$store->store_name}}</h2>
                                      <h3 class="center">Add your Price</h3> -->
                                      <form action = "{{ route('add.price') }}" method = "post"  enctype="multipart/form-data">
                                          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                          <div class="form-group">
                                              <input type="text" class="form-control " name="price" width="100" placeholder="Your Price" required style="width: 100px;float: left"> $
                                              <input type="hidden" name="pid" class="pid" value="{{$allproducts->id}}">
                                              <input type="hidden" name="sid" class="sid" value="{{$store->id}}">
                                          </div>


                                          <input type="submit" class="button btn " value="Add Price">
                                      </form>
                                  </div>
                                <?php } ?>
                            </td>
                            <!-- <td>
                              <a href="{{ route('product', $allproducts->slug) }}"><br><p class="right"></p>
                                <button type="button" class="btn btn-default btn-sm">
                                  <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    Add to Cart
                                </button>
                              </a>
                            </td> -->
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                   </div>
               <?php
           } else { ?>



    <div class="col-md-6">
<h2 class="center">Register your store</h2>
        <form action = "{{ route('create.store') }}" method = "post"  enctype="multipart/form-data">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="form-group">
                <input type="text" class="form-control " name="name" placeholder="Store Name" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control " name="address" placeholder="Store Address" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control " name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control " name="pwd" placeholder="Password" required>
            </div>
            <div class="input-group control-group increment" >
                <label>Upload logo</label>
                <input type="file" name="filename" class="form-control">

                </div>
            <input type="submit" class="button btn " value="Submit">
        </form>
    </div>

    <div class="col-md-6">

        <h2 class="center">Login your store</h2>
        <form action = "{{ route('login.check') }}" method = "post" >
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <div class="form-group">
                <input type="email" class="form-control " name="semail" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control " name="spwd" placeholder="Password" required>
            </div>

            <input type="submit" class="button btn " value="Login">
        </form>
    </div>
</div>
    <?php } ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script type="text/javascript">
    $(document).on('click','.editButton',function(){
        var productPrice = $(this).parent().parent().find('.productPrice').text();
        var html = '<input type="text" class="updatedPrice" value="'+productPrice+'"><span class="priceError"></span>';
        $(this).parent().parent().find('.productPrice').html(html);

        $(this).text('Save');
        $(this).addClass('saveButton');
        $(this).removeClass('editButton');
    })

    $(document).on('click','.saveButton',function(){
        var productPrice =  $(this).parent().parent().find('.updatedPrice').val();
        if(productPrice == '' || productPrice == 0){
          $(this).parent().parent().find('.priceError').text('Please enter Price.');
          return false;
        }
        //var html = '<input type="text" class="updatedPrice" value="'+productPrice+'">';
        

        $(this).text('Edit');
        $(this).addClass('editButton');
        $(this).removeClass('saveButton');

        var sid = $(this).siblings('.new_sid').val();

        var pid = $(this).next('.new_pid').val();
        $(this).parent().parent().find('.productPrice').html(productPrice);
        var _token = '<?php echo csrf_token(); ?>';
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{url("/store/productPrice")}}',
            data: {'price': productPrice,'sid': sid,'pid': pid,'_token':_token},
            success: function(data){
              // console.log(data.success)
              if (data.code == 200) {
                alert('Price updated Successfully.');
              }
              
            }
        });
    })
</script>
@endsection
