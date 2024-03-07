@extends('user.layout.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $productData->image) }}" alt="Image">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <div class="row">
                        <h3 class="col-6">{{ $productData->name }}</h3>
                        <div class="col-2 offset-4">
                            <a href="{{ route('user#home') }}"> <button class="btn bg-dark text-white">Cancel</button></a>
                        </diV>
                    </div>
                       <input type="hidden" value="{{Auth::user()->id}}" id="userId">
                        <input type="hidden" value="{{$productData->id}}" id="productId">
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">({{ $productData->view_count + 1}} View)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $productData->price }}Ks</h3>
                    <p class="mb-4">{{ $productData->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control border-0 text-center" value="1" id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addCartBtn" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">

            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($productList as $pList)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $pList->image) }}" alt=""
                                    class="img-thumbnail shadow-sm w-100" style="height: 180px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-cart-shopping"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#productDetails', $pList->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pList->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pList->price }}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>({{ $pList->view_count }})</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            //increase view count
                $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/product/viewCount',
                        data: {
                            'productId' : $('#productId').val(),
                        },
                        dataType: 'json',

                      })

            $('#addCartBtn').click(function(){
                //   alert($('#orderCount').val());


                $source = {
                'count' : $('#orderCount').val(),
                'userId' : $('#userId').val(),
                'productId' : $('#productId').val()
                };
                // console.log($source);
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/order/count',
                        data: $source,
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                            if(response.status == 'success'){
                                window.location.href = "http://127.0.0.1:8000/user/home";
                            }
                            }
                            // console.log($list);

                      })

            })

            });
    </script>
@endsection
