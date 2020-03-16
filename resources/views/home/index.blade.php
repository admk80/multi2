@extends('layouts.app')

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
        <div class="row">

            <?php
            foreach($products as $product){?>
            <div class="col-md-3 product">
                <div class="pimg">
                    <?php
                        $images=$product->gallery;
                        $all=explode(',',$images);
                    ?>
                <img src="../public/images/<?php echo($all[0]);?>">
                </div>
<div class="title"><a href="{{ route('product', $product->slug) }}"> <?=$product->title;?></a></div>
                <div class="desc">{{ \Illuminate\Support\Str::limit($product->description, 150, $end='...') }}<a href="{{ route('product', $product->slug) }}"><br><p class="right"></p>  <strong>${{$product->price}}</strong><br>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            Add to Cart
                        </button></a> </p></div>
            </div>
                <?php } ?>
        </div>
        </div>

@endsection
