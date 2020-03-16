@extends('layouts.app')
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.3/dist/css/uikit.min.css"/>

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.3/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.3/dist/js/uikit-icons.min.js"></script>

@section('content')
    <!-- ======== Start Slider ======== -->
    {{--        <section class="slider d-flex align-items-center" id="slider">--}}
    {{--            <div class="container">--}}
    {{--                <div class="content">--}}
    {{--                    <div class="row d-flex align-items-center">--}}
    {{--                        <div class="col-md-6">--}}
    {{--                            <div class="left">--}}
    {{--                                <h3>Save weeks of time and build your Vue.js & Laravel SaaS app in minutes.</h3>--}}
    {{--                                    <p>--}}
    {{--                                        <strong>SaaSWeb provides the Ultimate starter kit for multi-tenant SaaS project on top of Laravel and Vue framework.</strong>--}}
    {{--                                    </p>--}}
    {{--                                    <p>--}}
    {{--                                    SaaSWeb will help you rapidly build your Software as a Service application. Out of the box Authentication,--}}
    {{--                                    Subscriptions, Billing, Team management, Invoices, Support ticket, Notifications, User Profiles, landing page,--}}
    {{--                                    API, two-factor authentication, Statistics, Visitor log, Env editor, Admin Panel to manage Plans, Coupons, Roles,--}}
    {{--                                    Permissions and so much more !--}}
    {{--                                </p>--}}
    {{--                                <a href="{{ route('register') }}" class="btn-1">Get Started</a>--}}
    {{--                                <a href="/docs" class="btn-2">View documention</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <!-- Right-->--}}
    {{--                        <div class="col-md-6">--}}
    {{--                            <div class="right">--}}
    {{--                                <img src="{{ asset('saas/img/slider-img.png') }}" alt="slider-img" class="img-fluid wow fadeInRight" data-wow-offset="1">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--        <!-- ======== End Slider ======== -->--}}

    <!-- ======== Start Features ======== -->
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


            <div class="col-md-5">
                <div class="pimg">
                    <div uk-lightbox>

                        <?php
                        $images = $product->gallery;
                        $all = explode(',', $images);
                        $length = count($all);

                        ?>
                        <a href="../../public/images/<?=$all[0];?>" data-toggle="lightbox">
                            <img src="../../public/images/<?=$all[0];?>">
                        </a>
                    </div>
                </div>
                <div class="gallery">
                    <div uk-lightbox>

                        <?php foreach ($all as $image) {

                            echo
                            "<a href=../../public/images/$image data-toggle='lightbox'><img src=../../public/images/$image /></a>";
                        }

                        ?></div>

                </div>
            </div>
            <div class="col-md-7">
                <h1 class="h-1">{{$product->title}}</h1>
                <div class="desc">{!!$product->description!!}</div>
                <div class="adminprice"><strong>Price: ${{$product->price}}</strong></div>
                <hr>
                @if(isset($product->brand_name))
                <div class="category">Brand: {{$product->brand_name}}</div>
                @endif
                <div class="category">Category: {{$product->cname}}</div>
                <div class="prices">
                    <h1 class="center">Product Prices</h1>
                    <table class="table" width="100%">
                        <th class="center"></th>
                        <th class="center">Store Name</th>
                        <th class="center">Price</th>
                        <th class="center"></th>

                        @foreach($prices as $price)
                            <tr>
                                <td>
                                    <div uk-lightbox><a href="../../public/images/{{$price->logo}}"> <img
                                                    src="../../public/images/{{$price->logo}}" width="75"></a></div>
                                </td>
                                <td>{{$price->store_name}}</td>
                                <td>${{$price->price}}</td>
                                <td>
                                    <button onclick="addToCart({{$product->id}},{{$price->store_id}},{{$price->price}})"
                                            type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                        Add to Cart
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addToCart(productId, storeId, price) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{url("add_to_cart")}}',
                data: { "_token": "{{ csrf_token() }}",'product_id': productId, 'store_id': storeId, 'price': price},
                success: function (data) {
                     console.log(data)
                    if (data.status=='success') {
                        alert('Product added to cart.');
                    }else{
                        alert('Product not added to cart.');
                    }
                    
                }
            });
        }
    </script>
@endsection
