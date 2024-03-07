{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <h2> User Home Page </h2>

   <h3> Role - {{Auth::user()->role}}</h3>

    <form action="{{route('logout')}}" method="POST">
    @csrf
    <input type="submit" value="Log Out">
    </form>
</body>
</html> --}}

@extends('user.layout.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3">

                            <span class="py-2">Categories</span>
                            <span class="badge border font-weight-normal p-2">{{ count($category) }}</span>
                        </div>
                         <div class="custom-control d-flex align-items-center justify-content-between mb-3">

                                <a href="{{route('user#home')}}" class="text-dark">All</a>

                            </div>
                        @foreach ($category as $c)
                            <div class="custom-control d-flex align-items-center justify-content-between mb-3">

                                <a href="{{route('user#categoryFilter', $c->id)}}" class="text-dark">{{ $c->name }}</a>

                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                               <a href="{{route('user#cartPage')}}"> <button class="btn btn-outline-dark "><i
                                                class="fa-solid fa-cart-shopping me-2"></i>{{count($cart)}}</button></a>
                               <a href="{{route('user#history')}}"> <button class="btn btn-outline-dark ml-2"><i class="fa-solid fa-clock-rotate-left fa-1x mr-1"></i>History {{count($history)}}</button></a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row" id="dataList">
                        @if (count($product) != 0)
                        @foreach ($product as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden ">
                                    <img class="img-fluid w-100" style="height: 230px"
                                        src="{{ asset('storage/' . $p->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-cart-shopping"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetails',$p->id)}}"><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $p->price}} Ks</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                         @endforeach

                        @else
                         <div class="noDataBox">
                            <div class="text-secondary col-6 offset-3 text-center mt-5"><h4>There is no data now..</h4></div>
                         </div>
                        @endif
                    </div>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $.ajax(
            //     type: 'get',
            //     url: 'http://127.0.0.1:8000/user/ajax/product/list',
            //     dataType: 'json',
            //     success: function(response){
            //         console.log(response);
            //     }
            // )

            $('#sortingOption').change(function() {
                 $eventOption = $('#sortingOption').val();
                // console.log($eventOption);

                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/product/list',
                        data: {'status':'asc'},
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response[0].name);
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `
                                 <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden ">
                                    <img class="img-fluid w-100" style="height: 230px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-cart-shopping"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}Ks</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                                `;
                            }
                            // console.log($list);
                            $('#dataList').html($list);

                      }
                    })

                } else if ($eventOption == 'desc') {
                    // console.log('last in first out')
                     $.ajax({
                        type: 'get',
                        url: '/user/ajax/product/list',
                        data: {'status':'desc'},
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                              $list = '';
                            for($i=0;$i<response.length;$i++){
                                $list += `
                                 <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden ">
                                    <img class="img-fluid w-100" style="height: 230px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-cart-shopping"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}Ks</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                                `;
                            }
                            // console.log($list);
                            $('#dataList').html($list);
                      }
                    })
                }
            })
        });
    </script>
@endsection
